export default function initSidebarCollapse() {
    const appShell   = document.querySelector('.app-shell');
    const expandBtns = document.querySelectorAll('#sidebar-expand-btn, #navbar-side-expand-btn');

    if (!appShell) return;

    expandBtns.forEach(btn => {
        btn?.addEventListener('click', () => {
            appShell.classList.toggle('collapsed');
        });
    });
}