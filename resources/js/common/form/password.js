window.showPassword = function (event) {
    const iconbBtn = event.target;
    const btn = iconbBtn.closest(".show-password");

    if (!btn) {
        return;
    }

    const input = btn.closest(".input-field")?.querySelector("input");
    const icon = btn.querySelector("i");

    if (!input || !icon) {
        return;
    }

    const isPassword = input.type === "password";

    // Toggle input type
    input.type = isPassword ? "text" : "password";

    // Toggle icon classes
    icon.classList.toggle("fi-tc-eye-crossed", !isPassword);
    icon.classList.toggle("fi-tc-eye", isPassword);
};
