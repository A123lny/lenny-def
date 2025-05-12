/**
 * Format Utilities
 * Funzioni di utilità per la formattazione di date, valute e numeri
 * @module FormatUtils
 */

// Verifica se FormatUtils esiste già prima di definirlo
if (typeof FormatUtils === 'undefined') {
    
    const FormatUtils = (function() {
        /**
         * Formatta un numero come valuta
         * @param {number} amount - Importo da formattare
         * @param {string} currency - Valuta (default: EUR)
         * @param {string} locale - Locale per la formattazione (default: it-IT)
         * @returns {string} - Stringa formattata come valuta
         */
        function formatCurrency(amount, currency = 'EUR', locale = 'it-IT') {
            return amount.toLocaleString(locale, { 
                style: 'currency',
                currency: currency 
            });
        }
        
        /**
         * Formatta una data in formato leggibile
         * @param {Date|string} date - Data da formattare
         * @param {Object} options - Opzioni di formattazione
         * @returns {string} - Stringa di data formattata
         */
        function formatDate(date, options = {}) {
            const defaultOptions = { 
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            
            const dateObj = (typeof date === 'string') ? new Date(date) : date;
            const formattingOptions = { ...defaultOptions, ...options };
            
            return dateObj.toLocaleDateString('it-IT', formattingOptions);
        }
        
        /**
         * Formatta un orario in formato leggibile
         * @param {Date|string} time - Orario da formattare
         * @param {boolean} includeSeconds - Se includere i secondi
         * @returns {string} - Stringa di orario formattata
         */
        function formatTime(time, includeSeconds = false) {
            const dateObj = (typeof time === 'string') ? new Date(time) : time;
            
            const options = {
                hour: '2-digit',
                minute: '2-digit'
            };
            
            if (includeSeconds) {
                options.second = '2-digit';
            }
            
            return dateObj.toLocaleTimeString('it-IT', options);
        }
        
        /**
         * Formatta una data e ora in formato leggibile
         * @param {Date|string} datetime - Data e ora da formattare
         * @param {boolean} includeSeconds - Se includere i secondi
         * @returns {string} - Stringa di data e ora formattata
         */
        function formatDateTime(datetime, includeSeconds = false) {
            const dateObj = (typeof datetime === 'string') ? new Date(datetime) : datetime;
            
            return `${formatDate(dateObj)} ${formatTime(dateObj, includeSeconds)}`;
        }
        
        /**
         * Formatta un numero con separatore di migliaia
         * @param {number} number - Numero da formattare
         * @param {number} decimals - Numero di decimali (default: 0)
         * @returns {string} - Numero formattato
         */
        function formatNumber(number, decimals = 0) {
            return number.toLocaleString('it-IT', { 
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            });
        }
        
        /**
         * Formatta un numero come percentuale
         * @param {number} value - Valore da formattare
         * @param {number} decimals - Numero di decimali (default: 2)
         * @returns {string} - Percentuale formattata
         */
        function formatPercent(value, decimals = 2) {
            return value.toLocaleString('it-IT', { 
                style: 'percent',
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            });
        }
        
        /**
         * Formatta un numero di telefono in formato italiano
         * @param {string} phoneNumber - Numero di telefono da formattare
         * @returns {string} - Numero di telefono formattato
         */
        function formatPhoneNumber(phoneNumber) {
            if (!phoneNumber) return '';
            
            // Rimuovi tutti i caratteri non numerici
            const cleaned = phoneNumber.replace(/\D/g, '');
            
            // Formatta il numero in base alla lunghezza
            if (cleaned.length === 10) {
                // Numero mobile italiano: 3XX XXX XXXX
                return cleaned.replace(/(\d{3})(\d{3})(\d{4})/, '$1 $2 $3');
            } else if (cleaned.length === 9) {
                // Numero fisso: 0XX XXX XXX
                return cleaned.replace(/(\d{2})(\d{3})(\d{4})/, '$1 $2 $3');
            } else {
                // Altri formati, gestisci gruppi di 3-4 cifre
                return cleaned.replace(/(\d{2,3})(?=\d)/g, '$1 ').trim();
            }
        }
        
        /**
         * Formatta una distanza in km o m
         * @param {number} meters - Distanza in metri
         * @returns {string} - Distanza formattata
         */
        function formatDistance(meters) {
            if (meters < 1000) {
                return `${Math.round(meters)} m`;
            } else {
                const km = meters / 1000;
                return `${km.toFixed(1)} km`;
            }
        }
        
        /**
         * Formatta una durata in formato leggibile
         * @param {number} minutes - Durata in minuti
         * @returns {string} - Durata formattata
         */
        function formatDuration(minutes) {
            if (!minutes && minutes !== 0) return '';
            
            const hours = Math.floor(minutes / 60);
            const mins = Math.floor(minutes % 60);
            
            if (hours === 0) {
                return `${mins} min`;
            } else if (mins === 0) {
                return `${hours} h`;
            } else {
                return `${hours} h ${mins} min`;
            }
        }
        
        /**
         * Formatta un tempo trascorso (es. "5 minuti fa")
         * @param {Date|string} date - Data da cui calcolare il tempo trascorso
         * @returns {string} - Tempo trascorso formattato
         */
        function formatTimeAgo(date) {
            const dateObj = (typeof date === 'string') ? new Date(date) : date;
            const now = new Date();
            const diffInSeconds = Math.floor((now - dateObj) / 1000);
            
            if (diffInSeconds < 60) {
                return 'Adesso';
            }
            
            const diffInMinutes = Math.floor(diffInSeconds / 60);
            if (diffInMinutes < 60) {
                return `${diffInMinutes} ${diffInMinutes === 1 ? 'minuto' : 'minuti'} fa`;
            }
            
            const diffInHours = Math.floor(diffInMinutes / 60);
            if (diffInHours < 24) {
                return `${diffInHours} ${diffInHours === 1 ? 'ora' : 'ore'} fa`;
            }
            
            const diffInDays = Math.floor(diffInHours / 24);
            if (diffInDays < 7) {
                return `${diffInDays} ${diffInDays === 1 ? 'giorno' : 'giorni'} fa`;
            }
            
            const diffInWeeks = Math.floor(diffInDays / 7);
            if (diffInWeeks < 4) {
                return `${diffInWeeks} ${diffInWeeks === 1 ? 'settimana' : 'settimane'} fa`;
            }
            
            // Per date più vecchie, mostra la data formattata
            return formatDate(dateObj);
        }
        
        // API pubblica
        return {
            formatCurrency,
            formatDate,
            formatTime,
            formatDateTime,
            formatNumber,
            formatPercent,
            formatPhoneNumber,
            formatDistance,
            formatDuration,
            formatTimeAgo
        };
    })();

    // Esponi globalmente per retrocompatibilità
    window.formatCurrency = FormatUtils.formatCurrency;
    window.formatDate = FormatUtils.formatDate;
    window.formatTimeAgo = FormatUtils.formatTimeAgo;
}