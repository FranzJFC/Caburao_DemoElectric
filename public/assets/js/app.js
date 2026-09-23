document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => navbar?.classList.toggle('shadow', window.scrollY > 30), { passive: true });

    document.querySelectorAll('.password-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('input');
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            button.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            button.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    });

    const password = document.querySelector('#password');
    const indicator = document.querySelector('.password-strength');
    password?.addEventListener('input', () => {
        const value = password.value;
        const score = [value.length >= 8, /[a-z]/.test(value), /[A-Z]/.test(value), /\d/.test(value), /[^A-Za-z0-9]/.test(value)].filter(Boolean).length;
        const labels = ['Very weak', 'Weak', 'Fair', 'Good', 'Strong'];
        const colors = ['#dc3545', '#ef7d00', '#f2a900', '#14a37f', '#07845f'];
        if (!value) { indicator.innerHTML = ''; return; }
        const index = Math.max(0, score - 1);
        indicator.innerHTML = `<div class="strength-track"><div class="strength-bar" style="width:${score * 20}%;background:${colors[index]}"></div></div><small>${labels[index]} password</small>`;
    });

    document.querySelectorAll('form').forEach((form) => form.addEventListener('submit', () => {
        const button = form.querySelector('button[type="submit"]');
        if (button && form.checkValidity()) {
            button.disabled = true;
            button.dataset.label = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        }
    }));
});
