export default function initTablePagination(options = {}) {
    const table = document.querySelector(options.selector || ".table");

    if (!table) {
        return;
    }

    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    const paginationContainer = document.querySelector(
        options.paginationSelector || ".table-pagination",
    );

    const rowsPerPage = options.rowsPerPage || 10;
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    // Render table
    function renderTable() {
        rows.forEach((row, index) => {
            row.style.display =
                index >= (currentPage - 1) * rowsPerPage &&
                index < currentPage * rowsPerPage
                    ? ""
                    : "none";
        });

        renderPaginationControls();
    }

    function renderPaginationControls() {
        if (!paginationContainer) {
            return;
        }

        paginationContainer.innerHTML = "";

        // Prev button
        const prev = document.createElement("button");
        prev.textContent = "← Prev";

        // Disable prev button if in first page
        if (currentPage === 1) {
            prev.disabled = true;
        }

        prev.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        paginationContainer.appendChild(prev);

        // Page buttons
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");

            btn.textContent = i;

            if (i === currentPage) {
                btn.classList.add("active");
            }

            btn.addEventListener("click", () => {
                currentPage = i;
                renderTable();
            });

            paginationContainer.appendChild(btn);
        }

        // Next button
        const next = document.createElement("button");
        next.textContent = "Next →";

        if (currentPage === totalPages) {
            next.disabled = true;
        }

        next.addEventListener("click", () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });

        paginationContainer.appendChild(next);
    }

    renderTable();
}
