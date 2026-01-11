const themeButton = document.getElementById("theme-button");
const logo = document.getElementById("logo");

function setTheme(dark) {
    if (dark) {
        document.documentElement.classList.add("dark");
        localStorage.theme = "dark";
        if (logo) logo.src = logo.dataset.dark;
        if (themeButton) themeButton.innerText = "Light";
    } else {
        document.documentElement.classList.remove("dark");
        localStorage.theme = "light";
        if (logo) logo.src = logo.dataset.light;
        if (themeButton) themeButton.innerText = "Dark";
    }
}

// On page load
export default function initTheme() {
    setTheme(
        localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches),
    );

    // On toggle
    if (themeButton) {
        themeButton.addEventListener("click", () => {
            setTheme(!document.documentElement.classList.contains("dark"));
        });
    }
}
