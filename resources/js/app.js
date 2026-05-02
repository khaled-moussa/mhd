import "./bootstrap";

import initSidebarCollapse from "./components/sidebar/sidebar-collapse.js";
import globalException from "./exceptions/global-exception.js";
import { initMicroModal } from "./components/modal/_modal.js";
import { initFlowbite } from "flowbite";
import showPassword from "@js/common/form/password.js";
import resetFormValidation from "@js/common/form/reset-form-validation.js";

/* 
|------------------------------- 
| Meta Glob 
|------------------------------- 
*/
import.meta.glob([
    "../assets/images/**",
    "../assets/videos/**",
]);

/* 
|------------------------------- 
| Helpers 
|------------------------------- 
*/
const initCommonScripts = () => {
    initMicroModal();
    showPassword();
};

const initSidebarScripts = () => {
    initSidebarCollapse();
};

const initUIComponents = () => {
    initFlowbite();
};

/* 
|------------------------------- 
| Init App
|------------------------------- 
*/
const initApp = () => {
    initCommonScripts();
    initSidebarScripts();
    initUIComponents();
};

/* 
|------------------------------- 
| Events 
|------------------------------- 
*/
window.addEventListener("DOMContentLoaded", initApp);

// document.addEventListener("livewire:navigated", initApp);