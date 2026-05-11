export class DragFiles {
    constructor({ dragArea, fileInput, onDrop }) {
        this.dragArea = dragArea;
        this.fileInput = fileInput;
        this.onDrop = onDrop;

        this.init();
    }

    init() {
        this.handleDragOver = this.handleDragOver.bind(this);
        this.handleDragLeave = this.handleDragLeave.bind(this);
        this.handleDrop = this.handleDrop.bind(this);
        this.handleInputChange = this.handleInputChange.bind(this);

        this.dragArea.addEventListener("dragover", this.handleDragOver);
        this.dragArea.addEventListener("dragleave", this.handleDragLeave);
        this.dragArea.addEventListener("drop", this.handleDrop);

        this.fileInput.addEventListener("change", this.handleInputChange);
    }

    handleDragOver(e) {
        e.preventDefault();
        this.dragArea.classList.add("focus");
    }

    handleDragLeave() {
        this.dragArea.classList.remove("focus");
    }

    handleDrop(e) {
        e.preventDefault();
        this.dragArea.classList.remove("focus");

        const files = Array.from(e.dataTransfer.files);
        this.onDrop?.(files);
    }

    handleInputChange(e) {
        const files = Array.from(e.target.files);
        this.onDrop?.(files);

        // reset input to allow re-selecting same file
        this.fileInput.value = null;
    }

    destroy() {
        this.dragArea.removeEventListener("dragover", this.handleDragOver);
        this.dragArea.removeEventListener("dragleave", this.handleDragLeave);
        this.dragArea.removeEventListener("drop", this.handleDrop);
        this.fileInput.removeEventListener("change", this.handleInputChange);
    }
}
