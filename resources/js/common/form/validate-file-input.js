/**
 * Validate file input.
 */
export default function validateFileInput(
    filesInput,
    {
        allowedExtensions = ["jpg", "jpeg", "png", "webp", "gif"],
        maxSizeInMB = null,
    } = {},
) {
    /*
    |------------------------------------------------------------------
    | Normalize Files
    |------------------------------------------------------------------
    */
    const files =
        filesInput instanceof HTMLInputElement
            ? Array.from(filesInput.files || [])
            : Array.from(filesInput || []);

    /*
    |------------------------------------------------------------------
    | State
    |------------------------------------------------------------------
    */
    const validFiles = [];
    const errors = [];

    /*
    |------------------------------------------------------------------
    | Validate Files
    |------------------------------------------------------------------
    */
    files.forEach((file) => {
        const extension = file.name.split(".").pop()?.toLowerCase();

        const isValidExtension = allowedExtensions.includes(extension);

        const isValidSize = maxSizeInMB
            ? file.size <= maxSizeInMB * 1024 * 1024
            : true;

        // Invalid extension
        if (!isValidExtension) {
            errors.push(
                `"${file.name}" has an invalid file type. Allowed: ${allowedExtensions.join(", ")}`,
            );

            return;
        }

        // Invalid size
        if (!isValidSize) {
            errors.push(
                `"${file.name}" exceeds the maximum size of ${maxSizeInMB}MB.`,
            );

            return;
        }

        validFiles.push(file);
    });

    /*
    |------------------------------------------------------------------
    | Response
    |------------------------------------------------------------------
    */
    return {
        validFiles,
        isValid: errors.length === 0,
        errorMessage: errors[0] || null,
        errors,
    };
}