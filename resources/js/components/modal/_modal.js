import MicroModal from "micromodal";

/*
|-----------------------------
| State
|-----------------------------
*/
let openCallback = null;
let closeCallback = null;

/*
|-----------------------------
|   Config
|-----------------------------
*/
export const config = {
    openTrigger: "data-custom-open",
    closeTrigger: "data-custom-close",
    openClass: "is-open",
    disableScroll: true,
    disableFocus: false,
    awaitOpenAnimation: true,
    awaitCloseAnimation: true,
    onShow: () => {
        executeAfterAnimation(openCallback);
        openCallback = null;
    },
    onClose: () => {
        executeAfterAnimation(closeCallback);
        closeCallback = null;
    },
};

/*
|-----------------------------
|   Helpers
|-----------------------------
*/
const ensureId = (id) => !!id;

const getAnimationDelay = () =>
    config.awaitCloseAnimation ? 300 : 0;

const executeAfterAnimation = (callback) => {
    if (typeof callback !== "function") {
        return;
    }

    setTimeout(callback, getAnimationDelay());
};

/*
|-----------------------------
|   Init
|-----------------------------
*/
export function initMicroModal() {
    MicroModal.init(config);
}

/*
|-----------------------------
|   Show Modal
|-----------------------------
*/
export function showModal({ modalId, callback, withEvent = false }) {
    if (!ensureId(modalId)) {
        return;
    }

    if (withEvent) {
        dispatchModalClosedEvent(modalId);
    }

    openCallback = callback;
    
    MicroModal.show(modalId, config);
}

/*
|-----------------------------
|   Close Modal
|-----------------------------
*/
export function closeModal({ modalId, callback, withEvent = false }) {
    if (!ensureId(modalId)) {
        return;
    }

    if (withEvent) {
        dispatchModalClosedEvent(modalId);
    }

    closeCallback = callback;
    MicroModal.close(modalId);
}

/*
|-----------------------------
| Events
|-----------------------------
*/
export function dispatchModalOpenedEvent(modalId, context) {
    const EVENT = `${modalId}-opened-event`;
    window.dispatchEvent(new CustomEvent(EVENT, {
        detail: context
    }));
}

export function dispatchModalClosedEvent(modalId) {
    const EVENT = `${modalId}-closed-event`;    
    window.dispatchEvent(new CustomEvent(EVENT, {}));
}

