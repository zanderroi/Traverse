// Toggle password visibility
const togglePassword = (inputId, toggleButtonId) => {
    const input = document.getElementById(inputId);
    const toggleButton = document.getElementById(toggleButtonId);

    toggleButton.addEventListener('click', () => {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);

        toggleButton.firstChild.classList.toggle('text-gray-500');
        toggleButton.firstChild.classList.toggle('text-gray-700');
    });
};

togglePassword('new_password', 'toggle_password');
togglePassword('new_password_confirmation', 'toggle_password_confirmation');
