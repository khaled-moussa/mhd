export default function initNavbar() {
    const navbar = document.getElementById('landing-navbar');

    if (!navbar) return;

    const toggleScrolledState = () => {
        navbar.classList.toggle('navbar-scrolled', window.scrollY > 0);
    };

    window.addEventListener('scroll', toggleScrolledState);

    toggleScrolledState();
}