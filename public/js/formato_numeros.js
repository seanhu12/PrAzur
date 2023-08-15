$(document).ready(function () {

    /**
     * Cambia el formato del numero a 1.000.000,000
     */
    window.formatoDecimalInput = function(numeroEntrada) {
        var numero = numeroEntrada;
        if (numero === '') {
            return '';
        }
        if (numero !== '.') {
            numero = numero.replace(/\./g, '');
        }
        numero = numero.replace(',','.');
        if (numero[numero.length - 1] === '.') {
            numero = numero.replace('.','');
            numero = parseFloat(numero);
            if (isNaN(numero)) {
                return '';
            }
            numero = numero.toString();
            // maximo 9 caracteres
            numero = numero.slice(0, 9);
            numeroConFormato = new Intl.NumberFormat('es-ES').format(numero);
            return numeroConFormato + ',';
        }
        numero = parseFloat(numero);
        if (isNaN(numero)) {
            return '';
        }
        numero = numero.toString();
        // maximo 9 caracteres
        numero = numero.slice(0, 9);
        numeroConFormato = new Intl.NumberFormat('es-ES', { maximumFractionDigits: 1 }).format(numero);
        return numeroConFormato;
    };

    /**
     * Quita el formato de numero
     * @param {string} numeroEntrada
     * @return numeroSinFormato
     */
    window.quitarFormatoDecimal = function(numeroEntrada) {
        var numero = numeroEntrada;
        numero = numero.replace(/\./g, '');
        var numeroSinFormato = numero.replace(',', '.');
        return numeroSinFormato
    }

    /**
     * Solo perite que se ingresen numeros usar, maximo 9 caracteres, usar keyup
     * @param {string} numeroEntrada
     * @returns numeroConFormato
     */
    window.numeroInput = function(numeroEntrada) {
        var numero = numeroEntrada;
        if (numero === '') {
            return '';
        }
        if (numero !== '.') {
            numero = numero.replace(/\./g, '');
        }
        numero = numero.toString();
        // En caso que el numero sea muy largo
        if (numero.length > 15) {
            numeroPrimerosDigitos = numero.slice(0, 15);
            numeroUltimosDigitos = numero.slice(15);
            numeroPrimerosDigitos = parseInt(numeroPrimerosDigitos);
            numeroUltimosDigitos = parseInt(numeroUltimosDigitos);
            if (isNaN(numeroPrimerosDigitos)) {
                return '';
            }
            if (isNaN(numeroUltimosDigitos)) {
                return numeroPrimerosDigitos;
            }
            numeroPrimerosDigitos = numeroPrimerosDigitos.toString();
            numeroUltimosDigitos = numeroUltimosDigitos.toString();
            numero = numeroPrimerosDigitos + numeroUltimosDigitos;
        } else {
            numero = parseInt(numero);
            if (isNaN(numero)) {
                return '';
            }
        }
        numeroConFormato = numero;
        return numeroConFormato;
    }

    /**
     * Cambia el formato del numero a 1.000.000
     */
    window.formatoNumeroShow = function(numero) {
        var numeroFormateado = new Intl.NumberFormat('es-ES').format(numero)
        return numeroFormateado;
    };

    /**
     * Cambia el formato del numero a 1.000.000 usar, maximo 9 caracteres, usar keyup
     * @param {string} numeroEntrada
     * @returns numeroConFormato
     */
    window.formatoNumeroInput = function(numeroEntrada) {
        var numero = numeroEntrada;
        if (numero === '') {
            return '';
        }
        if (numero !== '.') {
            numero = numero.replace(/\./g, '');
        }
        numero = parseInt(numero);
        if (isNaN(numero)) {
            return '';
        }
        numero = numero.toString();
        // maximo 9 caracteres
        numero = numero.slice(0, 9);
        numeroConFormato = new Intl.NumberFormat('es-ES').format(numero);
        return numeroConFormato;
    }

    /**
     * Quita el formato de numero
     * @param {string} montoEntrada
     * @return montoSinFormato
     */
    window.quitarFormatoNumero = function(montoEntrada) {
        var monto = montoEntrada;
        montoSinFormato = monto.replace(/\./g, '');
        return montoSinFormato
    }

    /**
     * Cambia el formato del numero a $ 1.000.000
     */
    window.formatoDineroShow = function(monto) {
        var montoFormateado = new Intl.NumberFormat('es-ES').format(monto)
        var montoFormateado = '$ ' + montoFormateado;
        return montoFormateado;
    };

    /**
     * Cambia el formato del numero a $ 1.000.000 usar, maximo 9 caracteres, usar keyup
     * @param {string} montoEntrada
     * @returns montoConFormato
     */
    window.formatoDineroInput = function(montoEntrada) {
        var monto = montoEntrada;
        if (monto === '') {
            return '';
        }
        monto = monto.replace('$','');
        monto = monto.replace(' ','');
        if (monto !== '.') {
            monto = monto.replace(/\./g, '');
        }
        monto = parseInt(monto);
        if (isNaN(monto)) {
            return '';
        }
        monto = monto.toString();
        // maximo 9 caracteres
        monto = monto.slice(0, 9);
        var montoPesos = new Intl.NumberFormat('es-ES').format(monto);
        montoConFormato = '$ ' + montoPesos;
        return montoConFormato;
    }

    /**
     * Quita el formato de numero
     * @param {string} montoEntrada
     * @return montoSinFormato
     */
    window.quitarFormatoDinero = function(montoEntrada) {
        var monto = montoEntrada;
        monto = monto.replace('$','');
        monto = monto.replace(' ','');
        monto = monto.replace(/\./g, '');
        montoSinFormato = monto.replace(',','.');
        return montoSinFormato
    }

});