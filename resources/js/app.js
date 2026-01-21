import "./bootstrap";
import initTheme from "./common/theme/_theme";
import { initMicroModal } from "./components/modal/_modal.js";
import { initFlowbite } from "flowbite";

/* 
|------------------------------- 
| Helpers 
|------------------------------- 
*/
const initCommonScripts = () => {
    initMicroModal();
    initTheme();
};

const initSidebarScripts = () => {
    initSidebarCollapse();
};

const initUIComponents = () => {
    initFlowbite();
};

/* 
|------------------------------- 
| Events 
|------------------------------- 
*/
window.addEventListener("DOMContentLoaded", () => {
    initCommonScripts();
    initUIComponents();
});

document.addEventListener("livewire:navigated", () => {
    initCommonScripts();
    initSidebarScripts();
    initUIComponents();
});
