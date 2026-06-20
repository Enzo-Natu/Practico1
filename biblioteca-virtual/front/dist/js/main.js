document.addEventListener('DOMContentLoaded', () => {

  const filterBtns = document.querySelectorAll('.filter-btn');
  const bookItems  = document.querySelectorAll('.book-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {

      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filtro = btn.dataset.filter;

      bookItems.forEach(item => {
        if (filtro === 'todos' || item.dataset.type === filtro) {
          item.removeAttribute('data-hidden');
          item.style.display = '';
        } else {
          item.setAttribute('data-hidden', 'true');
          item.style.display = 'none';
        }
      });
    });
  });

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = 72;
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });

        const navCollapse = document.getElementById('navbarNav');
        if (navCollapse && navCollapse.classList.contains('show')) {
          const toggler = document.querySelector('.navbar-toggler');
          if (toggler) toggler.click();
        }
      }
    });
  });

  document.querySelectorAll('.btn-leer').forEach(btn => {
    btn.addEventListener('click', function () {
      const titulo = this.closest('.book-card').querySelector('.book-card-title').textContent;
      alert(`Próximamente disponible: "${titulo}"\n\nRegístrate para acceder a todo el catálogo.`);
    });
  });

  document.querySelectorAll('[data-scroll-to]').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.scrollTo;
      const el = document.getElementById(id);
      if (el) {
        const top = el.getBoundingClientRect().top + window.scrollY - 72;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  const navbar = document.querySelector('.navbar-biblio');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
      navbar.style.boxShadow = '0 2px 24px rgba(0,0,0,0.4)';
    } else {
      navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.3)';
    }
  });

});
