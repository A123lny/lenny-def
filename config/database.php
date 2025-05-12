<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $port = DB_PORT;
    private $conn;
    
    public function connect() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", 
                $this->user, 
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->exec("SET NAMES utf8");
        } catch(PDOException $e) {
            if (strpos($e->getMessage(), "Unknown database")) {
                // Se il database non esiste, lo creiamo
                $this->createDatabase();
                return $this->connect();
            } else {
                echo "Errore di connessione: " . $e->getMessage();
            }
        }
        
        return $this->conn;
    }
    
    private function createDatabase() {
        try {
            $tempConn = new PDO(
                "mysql:host={$this->host};port={$this->port}", 
                $this->user, 
                $this->pass
            );
            $tempConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Creare il database
            $tempConn->exec("CREATE DATABASE IF NOT EXISTS {$this->dbname} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            
            // Connettersi al nuovo database
            $tempConn->exec("USE {$this->dbname}");
            
            // Creare le tabelle
            $this->createTables($tempConn);
            
            // Inserire dati di esempio
            $this->insertSampleData($tempConn);
            
            echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; margin: 15px; border-radius: 5px;'>Database creato con successo! Ricarica la pagina.</div>";
        } catch(PDOException $e) {
            echo "Errore nella creazione del database: " . $e->getMessage();
        }
    }
    
    private function createTables($conn) {
        // Tabella users
        $conn->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            fullname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            role VARCHAR(20) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Tabella customers
        $conn->exec("CREATE TABLE IF NOT EXISTS customers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            address VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Tabella menu_categories
        $conn->exec("CREATE TABLE IF NOT EXISTS menu_categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            description TEXT,
            image VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Tabella menu_items
        $conn->exec("CREATE TABLE IF NOT EXISTS menu_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            category_id INT,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            price DECIMAL(10,2) NOT NULL,
            image VARCHAR(255),
            is_available BOOLEAN DEFAULT true,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES menu_categories(id) ON DELETE SET NULL
        )");
        
        // Tabella orders
        $conn->exec("CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id INT,
            order_number VARCHAR(20) NOT NULL UNIQUE,
            status VARCHAR(20) NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            payment_method VARCHAR(20) NOT NULL,
            notes TEXT,
            delivery_address VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL
        )");
        
        // Tabella order_items
        $conn->exec("CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            menu_item_id INT,
            quantity INT NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            notes TEXT,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
            FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE SET NULL
        )");
        
        // Tabella drivers
        $conn->exec("CREATE TABLE IF NOT EXISTS drivers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            vehicle_type VARCHAR(50) NOT NULL,
            vehicle_plate VARCHAR(20),
            status ENUM('attivo', 'inattivo', 'consegna') DEFAULT 'attivo',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Aggiungiamo la colonna driver_id alla tabella orders se non esiste
        $stmt = $conn->query("SHOW COLUMNS FROM orders LIKE 'driver_id'");
        if ($stmt->rowCount() == 0) {
            $conn->exec("ALTER TABLE orders ADD COLUMN driver_id INT NULL, ADD FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE SET NULL");
        }
    }
    
    private function insertSampleData($conn) {
        // Inserire utente admin
        $hashedPassword = password_hash(ADMIN_PASS, PASSWORD_DEFAULT);
        $conn->exec("INSERT INTO users (username, password, fullname, email, role) 
                    VALUES ('luca', '$hashedPassword', 'Luca Admin', 'admin@lenny.com', 'admin')");
        
        // Inserire categorie menu
        $categories = [
            ['Pizze', 'Le nostre pizze sono preparate con ingredienti freschi e genuini', 'pizza.jpg'],
            ['Hamburger', 'Hamburger gourmet con carne di prima qualità', 'burger.jpg'],
            ['Primi piatti', 'Primi piatti della tradizione italiana', 'pasta.jpg'],
            ['Insalate', 'Insalate fresche e leggere', 'salad.jpg'],
            ['Bevande', 'Bevande fresche e dissetanti', 'drinks.jpg'],
            ['Dolci', 'Dolci fatti in casa', 'dessert.jpg']
        ];
        
        foreach ($categories as $category) {
            $conn->exec("INSERT INTO menu_categories (name, description, image) 
                        VALUES ('{$category[0]}', '{$category[1]}', '{$category[2]}')");
        }
        
        // Inserire prodotti menu
        $menuItems = [
            [1, 'Margherita', 'Pomodoro, mozzarella e basilico', 8.50, 'margherita.jpg', 1],
            [1, 'Diavola', 'Pomodoro, mozzarella e salame piccante', 9.50, 'diavola.jpg', 1],
            [1, 'Quattro Formaggi', 'Mozzarella, gorgonzola, fontina e parmigiano', 10.00, 'quattro_formaggi.jpg', 1],
            [2, 'Classic Burger', 'Hamburger di manzo con insalata, pomodoro e maionese', 12.00, 'classic_burger.jpg', 1],
            [2, 'Cheese Burger', 'Hamburger di manzo con cheddar, insalata, pomodoro e salsa burger', 13.00, 'cheese_burger.jpg', 1],
            [3, 'Spaghetti alla Carbonara', 'Spaghetti con uova, guanciale, pecorino e pepe', 11.00, 'carbonara.jpg', 1],
            [3, 'Lasagne alla Bolognese', 'Lasagne con ragù di carne e besciamella', 12.00, 'lasagne.jpg', 1],
            [4, 'Insalata Mista', 'Insalata mista con pomodori, carote e olive', 6.00, 'insalata_mista.jpg', 1],
            [5, 'Coca Cola', 'Coca Cola in lattina 33cl', 3.00, 'coca_cola.jpg', 1],
            [5, 'Acqua Naturale', 'Acqua naturale 50cl', 1.50, 'acqua.jpg', 1],
            [6, 'Tiramisu', 'Tiramisu fatto in casa', 5.00, 'tiramisu.jpg', 1]
        ];
        
        foreach ($menuItems as $item) {
            $conn->exec("INSERT INTO menu_items (category_id, name, description, price, image, is_available) 
                        VALUES ({$item[0]}, '{$item[1]}', '{$item[2]}', {$item[3]}, '{$item[4]}', {$item[5]})");
        }
        
        // Inserire clienti di esempio
        $customers = [
            ['Mario Rossi', 'mario.rossi@example.com', '3331234567', 'Via Roma 123, Milano'],
            ['Giulia Verdi', 'giulia.verdi@example.com', '3339876543', 'Via Garibaldi 45, Roma'],
            ['Paolo Bianchi', 'paolo.bianchi@example.com', '3351122334', 'Corso Italia 67, Torino'],
            ['Laura Neri', 'laura.neri@example.com', '3387654321', 'Via Dante 89, Napoli'],
            ['Alessandro Gialli', 'alessandro.gialli@example.com', '3399988776', 'Piazza Duomo 12, Firenze']
        ];
        
        foreach ($customers as $customer) {
            $conn->exec("INSERT INTO customers (name, email, phone, address) 
                        VALUES ('{$customer[0]}', '{$customer[1]}', '{$customer[2]}', '{$customer[3]}')");
        }
        
        // Inserire ordini di esempio
        $orders = [
            [1, 'ORD-001', 'consegnato', 28.50, 'contanti', 'Citofonare al 2B', 'Via Roma 123, Milano'],
            [2, 'ORD-002', 'in preparazione', 25.00, 'carta', 'Senza cipolla', 'Via Garibaldi 45, Roma'],
            [3, 'ORD-003', 'in consegna', 35.00, 'contanti', '', 'Corso Italia 67, Torino'],
            [4, 'ORD-004', 'nuovo', 18.00, 'carta', 'Suonare al portone principale', 'Via Dante 89, Napoli'],
            [5, 'ORD-005', 'in preparazione', 42.50, 'contanti', '', 'Piazza Duomo 12, Firenze']
        ];
        
        foreach ($orders as $order) {
            $conn->exec("INSERT INTO orders (customer_id, order_number, status, total_amount, payment_method, notes, delivery_address) 
                        VALUES ({$order[0]}, '{$order[1]}', '{$order[2]}', {$order[3]}, '{$order[4]}', '{$order[5]}', '{$order[6]}')");
        }
        
        // Inserire elementi degli ordini
        $orderItems = [
            [1, 1, 2, 8.50, ''],
            [1, 5, 1, 13.00, 'Ben cotto'],
            [1, 9, 2, 3.00, ''],
            [2, 3, 1, 10.00, ''],
            [2, 10, 2, 1.50, ''],
            [2, 11, 1, 5.00, ''],
            [3, 2, 1, 9.50, 'Extra piccante'],
            [3, 6, 2, 11.00, ''],
            [3, 9, 1, 3.00, ''],
            [4, 8, 2, 6.00, 'Senza olive'],
            [4, 10, 1, 1.50, ''],
            [5, 4, 2, 12.00, ''],
            [5, 9, 2, 3.00, ''],
            [5, 11, 1, 5.00, '']
        ];
        
        foreach ($orderItems as $item) {
            $conn->exec("INSERT INTO order_items (order_id, menu_item_id, quantity, price, notes) 
                        VALUES ({$item[0]}, {$item[1]}, {$item[2]}, {$item[3]}, '{$item[4]}')");
        }
        
        // Inserire driver di esempio
        $drivers = [
            ['Marco Bianchi', 'marco.bianchi@example.com', '3331122334', 'Scooter', 'AB12345', 'attivo'],
            ['Giulia Rossi', 'giulia.rossi@example.com', '3334455667', 'Moto', 'CD67890', 'attivo'],
            ['Alessandro Verdi', 'alessandro.verdi@example.com', '3337788990', 'Auto', 'EF54321', 'inattivo'],
            ['Sara Neri', 'sara.neri@example.com', '3339900112', 'Bici', '', 'consegna']
        ];
        
        foreach ($drivers as $driver) {
            $conn->exec("INSERT INTO drivers (name, email, phone, vehicle_type, vehicle_plate, status) 
                        VALUES ('{$driver[0]}', '{$driver[1]}', '{$driver[2]}', '{$driver[3]}', '{$driver[4]}', '{$driver[5]}')");
        }
    }
}
?>
