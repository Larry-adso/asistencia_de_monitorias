document.addEventListener('DOMContentLoaded', function() {
    const idInput = document.getElementById('id');
    const idFeedback = document.getElementById('idFeedback');
    const nombreInput = document.getElementById('nombre');
    const nombreFeedback = document.getElementById('nombreFeedback');
    const emailInput = document.getElementById('email');
    const emailFeedback = document.getElementById('emailFeedback');
    const passwordInput = document.getElementById('password');
    const passwordFeedback = document.getElementById('passwordFeedback');
    const telefonoInput = document.getElementById('telefono');
    const telefonoFeedback = document.getElementById('telefonoFeedback');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('registroForm');
    const togglePassword = document.getElementById('togglePassword');
    const validateId = () => {
        const idValue = idInput.value;
        const remaining = 10 - idValue.length;
    
        if (/^\d{10}$/.test(idValue)) {
            idFeedback.textContent = 'Correcto';
            idFeedback.className = 'valid';
        } else if (remaining > 0) {
            idFeedback.textContent = `Faltan ${remaining} dígitos`;
            idFeedback.className = 'invalid';
        } else {
            idFeedback.textContent = 'Inválido';
            idFeedback.className = 'invalid';
        }
    };
    

    const validateNombre = () => {
        const nombreValue = nombreInput.value;
        if (/^[a-zA-Z\s]+$/.test(nombreValue)) {
            nombreFeedback.textContent = 'Correcto';
            nombreFeedback.className = 'valid';
        } else {
            nombreFeedback.textContent = 'Inválido';
            nombreFeedback.className = 'invalid';
        }
    };

    const validateEmail = () => {
        const emailValue = emailInput.value;
        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
            emailFeedback.textContent = 'Correcto';
            emailFeedback.className = 'valid';
        } else {
            emailFeedback.textContent = 'Inválido';
            emailFeedback.className = 'invalid';
        }
    };

    const validatePassword = () => {
        const passwordValue = passwordInput.value;
        let feedback = '';

        if (passwordValue.length < 8) {
            feedback = 'Debe tener 8 caracteres';
        } else if (!/[A-Z]/.test(passwordValue)) {
            feedback = 'Falta una mayúscula';
        } else if (!/\d/.test(passwordValue)) {
            feedback = 'Falta un número';
        } else {
            feedback = 'Correcto';
            passwordFeedback.className = 'valid';
            passwordFeedback.textContent = feedback;
            return; // Si es válido, no es necesario seguir evaluando
        }

        passwordFeedback.textContent = feedback;
        passwordFeedback.className = 'invalid';
    };

    const validateTelefono = () => {
        const telefonoValue = telefonoInput.value;
        if (/^\d{10}$/.test(telefonoValue)) {
            telefonoFeedback.textContent = 'Correcto';
            telefonoFeedback.className = 'valid';
        } else {
            telefonoFeedback.textContent = 'Inválido';
            telefonoFeedback.className = 'invalid';
        }
    };

    const validateForm = () => {
        const isIdValid = /^\d{10}$/.test(idInput.value);
        const isNombreValid = /^[a-zA-Z\s]+$/.test(nombreInput.value);
        const isEmailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
        const isPasswordValid = passwordFeedback.className === 'valid';
        const isTelefonoValid = /^\d{10}$/.test(telefonoInput.value);
        const isRolSelected = tipoPersona.selectedIndex > 0;
        const isAreaSelected = tipoArea.selectedIndex > 0;

        if (isIdValid && isNombreValid && isEmailValid && isPasswordValid && isTelefonoValid && isRolSelected && isAreaSelected) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    };

    idInput.addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^0-9]/g, '').slice(0, 10);
        validateId();
        validateForm();
    });

    nombreInput.addEventListener('input', () => {
        validateNombre();
        validateForm();
    });

    emailInput.addEventListener('input', () => {
        validateEmail();
        validateForm();
    });

    passwordInput.addEventListener('input', (event) => {
        event.target.value = event.target.value.slice(0, 8);
        validatePassword();
        validateForm();
    });

    telefonoInput.addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^0-9]/g, '').slice(0, 10);
        validateTelefono();
        validateForm();
    });

    tipoPersona.addEventListener('change', validateForm);
    tipoArea.addEventListener('change', validateForm);

    form.addEventListener('submit', (event) => {
        validateForm();
        if (submitBtn.disabled) {
            event.preventDefault();
        }
    });

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye');
        togglePassword.classList.toggle('fa-eye-slash');
    });
});
