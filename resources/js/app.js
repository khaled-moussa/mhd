import "./bootstrap";

/* 
|-------------------------------
| Components
|-------------------------------
*/
import initSidebarCollapse from "./components/sidebar/sidebar-collapse.js";
import { initMicroModal } from "./components/modal/_modal.js";
import { initFlowbite } from "flowbite";

/* 
|-------------------------------
| Common
|-------------------------------
*/
import "@js/common/form/password.js";
import resetFormValidation from "@js/common/form/reset-form-validation.js";
import globalException from "./exceptions/global-exception.js";
import initPageOnLoad from "./common/loader/_loader.js";

/* 
|-------------------------------
| Assets
|-------------------------------
*/
import.meta.glob([
    "../assets/images/**",
    "../assets/videos/**",
]);

/* 
|-------------------------------
| Initializers
|-------------------------------
*/
const initCommon = () => {
    initMicroModal();
};

const initUI = () => {
    initFlowbite();
};

const initCommonScripts = () => {
    initSidebarCollapse();
    initPageOnLoad();
    resetFormValidation();
};

/* 
|-------------------------------
| Bootstrap Events
|-------------------------------
*/
window.addEventListener("DOMContentLoaded", () => {
    initCommon();
    initUI();
});

document.addEventListener("livewire:navigated", () => {
    initCommon();
    initUI();
    initCommonScripts();
});