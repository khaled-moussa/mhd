import "./bootstrap";
import initSplideCarousel from "./common/carousel/_carousel";
import initTheme from "./common/theme/_theme";
import initSidebarCollapse from "./components/sidebar/sidebar-collapse.js";
import { initMicroModal } from "./components/modal/_modal.js";
import { initFlowbite } from "flowbite";

/* 
|------------------------------- 
| Helpers 
|------------------------------- 
*/
const initCommonScripts = () => {
    initMicroModal();
    initSplideCarousel();
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
