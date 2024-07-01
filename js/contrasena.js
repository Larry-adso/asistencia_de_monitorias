document.querySelector('.show-hide').addEventListener('click', function() {
    const passwordInput = document.querySelector('.pas');
    const icon = document.querySelector('.show-hide');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.name = 'eye-off-outline';
    } else {
        passwordInput.type = 'password';
        icon.name = 'eye-outline';
    }
});
