window.addEventListener("DOMContentLoaded", () => {
  const payload = {
    email: 'utente@example.com',
    password: 'utente'
  };

  fetch('api/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
});