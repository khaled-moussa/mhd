export default function initNavbar() {
    const navbar = document.getElementById("navbar-guest");
    const navToggleMobile = document.getElementById("nav-toggle");

    if (!navbar || !navToggleMobile) return;

    /* 
    |-------------------------------
    | Scroll State
    |-------------------------------
    */
    const toggleScrolledState = () => {
        navbar.classList.toggle("navbar-scrolled", window.scrollY > 0);
    };

    window.addEventListener("scroll", toggleScrolledState);
    toggleScrolledState();

    /* 
    |-------------------------------
    | Mobile Menu State (Fix)
    |-------------------------------
    */
    const handleMenuState = () => {
        document.body.classList.toggle("scroll-none", navToggleMobile.checked);
    };

    navToggleMobile.addEventListener("change", handleMenuState);
}

/* 
|-------------------------------
| Mobile Link Click Handler
|-------------------------------
*/
window.navLinkMobile = () => {
    const navToggleMobile = document.getElementById("nav-toggle");

    if (!navToggleMobile) return;

    navToggleMobile.checked = false;
};
