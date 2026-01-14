export function initDragFiles({ dragArea, fileInput, onDrop }) {
    dragArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        dragArea.classList.add("focus");
    });

    dragArea.addEventListener("dragleave", () => {
        dragArea.classList.remove("focus");
    });

    dragArea.addEventListener("drop", (e) => {
        e.preventDefault();
        dragArea.classList.remove("focus");
        onDrop(Array.from(e.dataTransfer.files));
    });

    fileInput.addEventListener("change", (e) => {
        onDrop(Array.from(e.target.files));
        fileInput.value = null;
    });
}
