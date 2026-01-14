/**
 * Validate image files.
 */
export default function validateImageFiles(
    filesInput,
    {
        allowedExtensions = ["jpg", "jpeg", "png", "webp", "gif"],
        maxSizeInMB = null,
    } = {},
) {
    let files = [];

    // Normalize input
    if (filesInput instanceof HTMLInputElement) {
        files = Array.from(filesInput.files || []);
    } else {
        files = Array.from(filesInput);
    }

    const validFiles = [];
    const invalidFiles = [];
    
    let invalidType = 0;
    let oversize = 0;

    files.forEach((file) => {
        const extension = file.name.split(".").pop().toLowerCase();
        const isValidType = allowedExtensions.includes(extension);
        const isValidSize = maxSizeInMB
            ? file.size <= maxSizeInMB * 1024 * 1024
            : true;

        if (!isValidType) {
            invalidType++;
            invalidFiles.push(file);
            return;
        }

        if (!isValidSize) {
            oversize++;
            invalidFiles.push(file);
            return;
        }

        validFiles.push(file);
    });

    return {
        validFiles,
        invalidFiles,
        errors: {
            invalidType,
            oversize,
        },
    };
}
