function initTableSort() {
    const table = document.querySelector(".table");
    if (!table) return;

    const tbody = table.querySelector("tbody");
    const headers = table.querySelectorAll(".table th");

    headers.forEach((header, colIndex) => {
        header.addEventListener("click", () => {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            const isAsc = header.classList.toggle("sort-asc");

            // Remove sort from other headers
            headers.forEach((h, i) => {
                if (i !== colIndex) h.classList.remove("sort-asc");
            });

            const sortedRows = rows.sort((a, b) => {

                const aText = a.children[colIndex].textContent
                    .trim()
                    .toLowerCase();
                const bText = b.children[colIndex].textContent
                    .trim()
                    .toLowerCase();

                // Detect numeric
                const aNum = parseFloat(aText.replace(/[^0-9.-]+/g, ""));
                const bNum = parseFloat(bText.replace(/[^0-9.-]+/g, ""));
                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return isAsc ? aNum - bNum : bNum - aNum;
                }

                return isAsc
                    ? aText.localeCompare(bText)
                    : bText.localeCompare(aText);
            });

            sortedRows.forEach((row) => tbody.appendChild(row));
        });
    });
}

// Initialize after DOM is ready
window.addEventListener("DOMContentLoaded", () => {
    initTableSort();
});
