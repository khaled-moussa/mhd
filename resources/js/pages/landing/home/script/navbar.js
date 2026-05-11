export default function initNavbar() {
    const navbar = document.getElementById("navbar-guest");
    const navToggleMobile = document.getElementById("nav-toggle");

    if (!navbar || !navToggleMobile) return;

    /*
    |-------------------------------
    | Page State
    |-------------------------------
    */

    const isLandingPage = window.location.pathname === "/";

    /*
    |-------------------------------
    | Scroll State
    |-------------------------------
    */

    const toggleScrolledState = () => {
        navbar.classList.toggle(
            "navbar-scrolled",
            !isLandingPage || window.scrollY > 0,
        );
    };

    window.addEventListener("scroll", toggleScrolledState);
    toggleScrolledState();

    /*
    |-------------------------------
    | Mobile Menu State
    |-------------------------------
    */

    const handleMenuState = () => {
        document.body.classList.toggle("scroll-none", navToggleMobile.checked);
    };

    navToggleMobile.addEventListener("change", handleMenuState);

    /*
    |-------------------------------
    | Desktop Reset State
    |-------------------------------
    */

    const handleDesktopResize = () => {
        if (window.innerWidth >= 1024) {
            navToggleMobile.checked = false;
            document.body.classList.remove("scroll-none");
        }
    };

    window.addEventListener("resize", handleDesktopResize);
    handleDesktopResize();
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
    document.body.classList.remove("scroll-none");
};
