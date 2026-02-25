document.addEventListener('DOMContentLoaded', () => {
  async function checkSession() {
    try {
      const res = await fetch('/api/session', { credentials: 'same-origin' });
      if (!res.ok) return showLoggedOut();
      const data = await res.json();
      if (data.logged) return showLoggedIn(data.user);
      showLoggedOut();
    } catch (e) {
      showLoggedOut();
    }
  }

  function showLoggedIn(user) {
    const authBtn = document.getElementById('auth-btn');
    if (!authBtn) return;

    const wrapper = document.createElement('div');
    wrapper.className = 'user-dropdown';

    wrapper.innerHTML = `
      <button id="user-btn" class="user-btn" aria-expanded="false" aria-haspopup="true">
        <i data-lucide="user" class="user-avatar" aria-hidden></i>
      </button>
      <div id="user-menu" class="dropdown-menu" role="menu" aria-hidden="true">
        <div class="menu-header">
          <div>Signed in as</div>
          <div class="menu-email">${escapeHtml(user.email)}</div>
        </div>
        <div class="divider" aria-hidden></div>
        <a href="dashboard.html" class="dropdown-item" role="menuitem">Dashboard</a>
        <a href="profile.html" class="dropdown-item" role="menuitem">Edit profile</a>
        <div class="divider" aria-hidden></div>
        <a id="logout-btn" class="dropdown-item" role="menuitem">Logout</a>
      </div>
    `;

    authBtn.replaceWith(wrapper);

    // If Lucide JS is available, render icons inside the newly inserted markup
    if (window.lucide && typeof lucide.createIcons === 'function') {
      lucide.createIcons();
    }

    const userBtn = document.getElementById('user-btn');
    const userMenu = document.getElementById('user-menu');
    const logoutBtn = document.getElementById('logout-btn');

    function openMenu(open) {
      userMenu.style.display = open ? 'block' : 'none';
      userMenu.setAttribute('aria-hidden', open ? 'false' : 'true');
      userBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const opened = userMenu.style.display === 'block';
      openMenu(!opened);
    });

    document.addEventListener('click', () => openMenu(false));

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') openMenu(false);
    });

    logoutBtn.addEventListener('click', async (e) => {
      e.preventDefault();
      try {
        await fetch('/api/logout', { method: 'POST' });
      } catch (e) {
        // ignore
      }
      window.location.reload();
    });
  }

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  }

  checkSession();
});
