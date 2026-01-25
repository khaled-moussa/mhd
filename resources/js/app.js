import "./bootstrap";
import initTheme from "./common/theme/_theme";
import initSidebarCollapse from "./components/sidebar/sidebar-collapse.js";
import globalException from "./exceptions/global-exception.js";
import { initMicroModal } from "./components/modal/_modal.js";
import { initFlowbite } from "flowbite";

/* 
|------------------------------- 
| Meta Glob 
|------------------------------- 
*/
import.meta.glob([
    "../assets/audios/**", // include all audios
    "../assets/images/**", // include all images
    "../assets/videos/**", // include all videos
]);

/* 
|------------------------------- 
| Helpers 
|------------------------------- 
*/
const initCommonScripts = () => {
    initMicroModal();
    initTheme();
    globalException();
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
