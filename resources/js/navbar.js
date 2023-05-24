
// Add the following JavaScript code to enable the hamburger menu functionality

const navbarToggle = document.querySelector('.navbar-toggler');
const navbarCollapse = document.querySelector('.navbar-collapse');

navbarToggle.addEventListener('click', () => {
  navbarCollapse.classList.toggle('show');
});
