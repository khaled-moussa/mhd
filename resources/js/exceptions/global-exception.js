import { UI_EVENTS } from "@js/utils/enums";
import MessageToast from "@js/utils/message-toast";

export default function globalException() {
    window.addEventListener(UI_EVENTS.GLOBAL_ERROR_EVENT, ({ detail }) => {
        const message = detail.message;
        MessageToast("error", message);
    });
}
