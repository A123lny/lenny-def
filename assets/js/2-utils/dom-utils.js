/**
 * DOM Utilities
 * Funzioni di utilità per la manipolazione del DOM
 * @module DOMUtils
 */

const DOMUtils = (function() {
    /**
     * Crea un elemento DOM con attributi e contenuto
     * @param {string} tag - Tag HTML da creare
     * @param {Object} attributes - Attributi da assegnare all'elemento
     * @param {string|HTMLElement|Array} content - Contenuto dell'elemento (stringa, elemento o array di elementi)
     * @returns {HTMLElement} Elemento DOM creato
     */
    function createElement(tag, attributes = {}, content = null) {
        const element = document.createElement(tag);
        
        // Imposta gli attributi
        for (const [key, value] of Object.entries(attributes)) {
            if (key === 'className') {
                element.className = value;
            } else if (key === 'dataset') {
                for (const [dataKey, dataValue] of Object.entries(value)) {
                    element.dataset[dataKey] = dataValue;
                }
            } else if (key === 'style') {
                for (const [styleKey, styleValue] of Object.entries(value)) {
                    element.style[styleKey] = styleValue;
                }
            } else if (key.startsWith('on')) {
                element.addEventListener(key.substring(2).toLowerCase(), value);
            } else {
                element.setAttribute(key, value);
            }
        }
        
        // Aggiunge il contenuto
        if (content !== null) {
            appendContent(element, content);
        }
        
        return element;
    }
    
    /**
     * Aggiunge contenuto a un elemento
     * @private
     * @param {HTMLElement} element - Elemento a cui aggiungere il contenuto
     * @param {string|HTMLElement|Array} content - Contenuto da aggiungere
     */
    function appendContent(element, content) {
        if (typeof content === 'string') {
            element.innerHTML = content;
        } else if (content instanceof HTMLElement) {
            element.appendChild(content);
        } else if (Array.isArray(content)) {
            content.forEach(item => {
                if (typeof item === 'string') {
                    element.innerHTML += item;
                } else if (item instanceof HTMLElement) {
                    element.appendChild(item);
                }
            });
        }
    }
    
    /**
     * Crea un effetto ripple su un elemento
     * @param {Event} event - Evento click
     */
    function createRippleEffect(event) {
        const element = event.currentTarget;
        
        // Rimuovi eventuali effetti precedenti
        const ripples = element.querySelectorAll('.ripple');
        ripples.forEach(ripple => ripple.remove());
        
        // Crea nuovo elemento per l'effetto
        const circle = document.createElement('span');
        circle.classList.add('ripple');
        element.appendChild(circle);
        
        // Posiziona e dimensiona l'effetto
        const d = Math.max(element.clientWidth, element.clientHeight);
        circle.style.width = circle.style.height = `${d}px`;
        
        const rect = element.getBoundingClientRect();
        circle.style.left = `${event.clientX - rect.left - d/2}px`;
        circle.style.top = `${event.clientY - rect.top - d/2}px`;
        
        // Aggiungi classe per l'animazione
        circle.classList.add('animate');
        
        // Rimuovi l'elemento dopo l'animazione
        setTimeout(() => {
            circle.remove();
        }, 600);
    }
    
    /**
     * Ottiene un cookie per nome
     * @param {string} name - Nome del cookie
     * @returns {string|null} Valore del cookie o null se non trovato
     */
    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }
    
    /**
     * Imposta un cookie
     * @param {string} name - Nome del cookie
     * @param {string} value - Valore del cookie
     * @param {Object} options - Opzioni del cookie (path, maxAge, etc.)
     */
    function setCookie(name, value, options = {}) {
        const defaultOptions = {
            path: '/',
            maxAge: 31536000, // 1 anno in secondi
            secure: location.protocol === 'https:'
        };
        
        const cookieOptions = { ...defaultOptions, ...options };
        let cookieString = `${name}=${value}`;
        
        for (const [key, val] of Object.entries(cookieOptions)) {
            if (val === true) {
                cookieString += `; ${key}`;
            } else if (val !== false) {
                cookieString += `; ${key.replace(/([A-Z])/g, '-$1').toLowerCase()}=${val}`;
            }
        }
        
        document.cookie = cookieString;
    }
    
    /**
     * Elimina un cookie
     * @param {string} name - Nome del cookie
     * @param {string} path - Path del cookie
     */
    function deleteCookie(name, path = '/') {
        document.cookie = `${name}=; path=${path}; max-age=0`;
    }
    
    /**
     * Ottiene un parametro dalla query string
     * @param {string} param - Nome del parametro
     * @returns {string|null} Valore del parametro o null se non trovato
     */
    function getUrlParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }
    
    /**
     * Applica effetti hover su un elemento
     * @param {HTMLElement} element - Elemento a cui applicare gli effetti
     * @param {Object} options - Opzioni per l'effetto hover
     */
    function applyHoverEffect(element, options = {}) {
        const defaultOptions = {
            translateY: '-5px',
            boxShadow: 'var(--shadow-md)',
            transition: 'transform 0.3s ease, box-shadow 0.3s ease'
        };
        
        const hoverOptions = { ...defaultOptions, ...options };
        const originalStyles = {
            transform: element.style.transform || '',
            boxShadow: element.style.boxShadow || '',
            transition: element.style.transition || ''
        };
        
        // Applica la transizione iniziale
        element.style.transition = hoverOptions.transition;
        
        element.addEventListener('mouseenter', function() {
            if (hoverOptions.translateY) {
                this.style.transform = `translateY(${hoverOptions.translateY})`;
            }
            if (hoverOptions.boxShadow) {
                this.style.boxShadow = hoverOptions.boxShadow;
            }
            if (hoverOptions.onEnter && typeof hoverOptions.onEnter === 'function') {
                hoverOptions.onEnter.call(this);
            }
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = originalStyles.transform;
            this.style.boxShadow = originalStyles.boxShadow;
            
            if (hoverOptions.onLeave && typeof hoverOptions.onLeave === 'function') {
                hoverOptions.onLeave.call(this);
            }
        });
        
        return {
            destroy: function() {
                element.removeEventListener('mouseenter', hoverOptions.onEnter);
                element.removeEventListener('mouseleave', hoverOptions.onLeave);
                element.style.transition = originalStyles.transition;
                element.style.transform = originalStyles.transform;
                element.style.boxShadow = originalStyles.boxShadow;
            }
        };
    }
    
    /**
     * Inizializza i tooltip di Bootstrap
     * @param {string} selector - Selettore per gli elementi con tooltip
     */
    function initTooltips(selector = '[data-bs-toggle="tooltip"]') {
        const tooltipTriggerList = document.querySelectorAll(selector);
        if (tooltipTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
            tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
        }
    }
    
    // API pubblica
    return {
        createElement,
        createRippleEffect,
        getCookie,
        setCookie,
        deleteCookie,
        getUrlParam,
        applyHoverEffect,
        initTooltips
    };
})();

// Esporta le funzionalità globalmente per retrocompatibilità
window.getCookie = DOMUtils.getCookie;
window.createRippleEffect = DOMUtils.createRippleEffect;