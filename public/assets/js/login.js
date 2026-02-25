(function () {
    const eye = document.querySelector('.eye');
    const icon = eye ? eye.querySelector('.material-icons') : null;
    const pwd = document.getElementById('password');
    if (eye && pwd && icon) {
        eye.addEventListener('click', () => {
            const showing = pwd.type === 'text';
            pwd.type = showing ? 'password' : 'text';
            icon.textContent = showing ? 'visibility' : 'visibility_off';
        });
    }

    const form = document.getElementById('login-form');
    const errorBox = document.getElementById('form-error');
    if (!form) return;
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        errorBox.style.display = 'none';
        const email = document.getElementById('email').value.trim();
        const password = pwd.value;
        try {
            const res = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            const data = await res.json();
            if (!res.ok) {
                errorBox.textContent = data.error || 'Errore durante il login';
                errorBox.style.display = 'block';
                return;
            }
            window.location.href = 'dashboard.html';
        } catch (err) {
            errorBox.textContent = 'Errore di rete';
            errorBox.style.display = 'block';
        }
    });
})();
