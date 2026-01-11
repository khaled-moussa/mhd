import { SUCCESS_MESSAGES, ERROR_MESSAGES } from "@js/constants/messages";
import { fireToast } from "@js/common/toast/toast";

export default function MessageToast(type, message) {
    let flag = "info";
    let msg = message;

    switch (type) {
        case "created":
            flag = "success";
            msg = message ?? SUCCESS_MESSAGES[type];
            break;

        case "updated":
            flag = "success";
            msg = message ?? SUCCESS_MESSAGES[type];
            break;

        case "deleted":
            flag = "success";
            msg = message ?? SUCCESS_MESSAGES[type];
            break;

        case "success":
            flag = "success";
            msg = message ?? SUCCESS_MESSAGES[type];
            break;

        case "info":
            flag = "info";
            msg = message;
            break;

        case "warning":
            flag = "warning";
            msg = message;
            break;

        case "error":
            flag = "danger";
            msg = ERROR_MESSAGES.default;
            break;
    }

    if (flag && msg) {
        fireToast(flag, msg);
    }
}
