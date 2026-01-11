export default function initSidebarCollapse() {
    const sidebar = document.getElementById("sidebar");

    if (!sidebar) {
        return;
    }

    const sidebarExpandBtn = document.getElementById("sidebar-expand-btn");

    const navbarSideExpandBtn = document.getElementById(
        "navbar-side-expand-btn",
    );
    
    const appShell = document.querySelector(".app-shell");

    sidebarExpandBtn.addEventListener("click", () => {
        appShell.classList.toggle("collapsed");
        sidebar.classList.toggle("collapsed");
    });

    navbarSideExpandBtn.addEventListener("click", () => {
        appShell.classList.toggle("collapsed");
        sidebar.classList.toggle("collapsed");
    });
}
