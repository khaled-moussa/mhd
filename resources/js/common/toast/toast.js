import Swal from "sweetalert2";

export function fireToast(status = "info", title = "", message = "") {
    // Status handler
    let toastTitle = statusHandler(status, title);

    // Toast initailize
    const Toast = Swal.mixin({
        toast: true,
        title: toastTitle,
        html: message,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: false,
        showCloseButton: true,
        closeButtonHtml: "<i class='ti ti-x'></i>",
        customClass: {
            title: "swal-title",
            header: "swal-header",
            closeButton: "close-btn",
        },
    });

    Toast.fire();
}

function statusHandler(status, title) {
    let toastTitle;
    switch (status) {
        case "success":
            toastTitle = `<i class="fi fi-ss-check-circle text-[#2a9a29]"></i> ${title}`;
            break;
        case "danger":
            toastTitle = `<i class="fi fi-sr-cross-circle text-[#c23c3c]"></i> ${title}`;
            break;
        case "warning":
            toastTitle = `<i class="fi fi-sr-engine-warning text-yellow-400"></i> ${title}`;
            break;
        case "info":
            toastTitle = `<i class="fi fi-tc-bell-ring text-current"></i> ${title}`;
            break;
    }

    return toastTitle;
}
