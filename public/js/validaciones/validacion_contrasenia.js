$(document).ready(function () {
    /*
     * Verificar que la contrasenia tenga entre 8 y 16 caracteres,
     * al menos un dígito, al menos una minúscula y al menos una mayúscula.
     * No puede tener otros símbolos.
     *
     * @returns true si es valido y false si no es valido
     */
    window.validarContrasenia = function(password,id) {
        if (password === '') {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        }
        passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/g;
        if (passwordRegex.test(password)) {
            window.document.getElementById(id).setAttribute('class', 'form-control');
            return true;
        } else {
            window.document.getElementById(id + '-alert').innerText = 'La contraseña debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. No puede contener otros símbolos.';
            window.document.getElementById(id).setAttribute('class', 'form-control is-invalid');
            return false;
        }
    };
});