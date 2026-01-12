    const RESPONSIVE_WIDTH = 1024;
    let isMenuOpen = false;

    const landingNavbar = document.getElementById("landing-navbar");
    const landingNavbarMenu = landingNavbar.querySelector("#landing-navbar-menu");
    const landingNavbarLinks = landingNavbar.querySelectorAll(".landing-navbar-link");
    const toggleLandingMenuBtn = landingNavbar.querySelector("#landing-toggle-menu-button");
    const toggleLandingMenuIcon = toggleLandingMenuBtn?.firstElementChild;

    export default function initLandingNavbarToggle() {
        if (!landingNavbar) return;

        if (!landingNavbarMenu || !toggleLandingMenuBtn || !toggleLandingMenuIcon) return;

        toggleMenu();
        closeMenu();
        handleResponsive();

        // Event listeners
        toggleLandingMenuBtn.addEventListener("click", toggleMenu);
        window.addEventListener("resize", handleResponsive);
    }

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;

        landingNavbar.classList.toggle("expanded", isMenuOpen);
        landingNavbarMenu.classList.toggle("collapsed", isMenuOpen);

        // Switch icon
        toggleLandingMenuIcon.classList.remove("fi-rr-menu-burger", "fi-sr-cross");
        toggleLandingMenuIcon.classList.add(
            isMenuOpen ? "fi-sr-cross" : "fi-rr-menu-burger",
        );

        // Close menu when a link is clicked (mobile)
        landingNavbarLinks.forEach((link) => {
            link.addEventListener("click", closeMenu);
        });
    }

    function closeMenu() {
        isMenuOpen = false;

        landingNavbar.classList.remove("expanded");
        landingNavbarMenu.classList.remove("collapsed");

        toggleLandingMenuIcon.classList.remove("fi-sr-cross");
        toggleLandingMenuIcon.classList.add("fi-rr-menu-burger");
    }

    function handleResponsive() {
        if (window.innerWidth >= RESPONSIVE_WIDTH) {
            closeMenu();
        }
    }
