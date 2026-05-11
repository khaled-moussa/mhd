import "./bootstrap";

// Components
import initSidebarCollapse from "./components/sidebar/sidebar-collapse.js";
import { initMicroModal } from "./components/modal/_modal.js";
import { initFlowbite } from "flowbite";

// Common
import "@js/common/form/password.js";
import resetFormValidation from "@js/common/form/reset-form-validation.js";
import globalException from "./exceptions/global-exception.js";
import initPageOnLoad from "./common/loader/_loader.js";

/* 
|------------------------------- 
| Meta Glob 
|------------------------------- 
*/
import.meta.glob(["../assets/images/**", "../assets/videos/**"]);

/* 
|------------------------------- 
| Helpers 
|------------------------------- 
*/
const initCommonScripts = () => {
    initPageOnLoad();
    initMicroModal();
};

const initSidebarScripts = () => {
    initSidebarCollapse();
    resetFormValidation();
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
    initSidebarScripts();
    initCommonScripts();
    initUIComponents();
});
