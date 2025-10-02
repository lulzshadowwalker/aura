import "./quicklink.js";
import "./textify.js";
import axios from "axios";

import Alpine from "alpinejs";
import ajax from "@imacrayon/alpine-ajax";
import focus from "@alpinejs/focus";
import lightbox from "alpine-tailwind-lightbox";

// NOTE: Uncomment to highlight overflowing elements for debugging
// document.querySelectorAll("*").forEach((el) => {
//     if (el.scrollWidth > document.documentElement.clientWidth) {
//         console.log("Overflowing element:", el);
//         el.style.outline = "3px solid red";
//     }
// });

window.Alpine = Alpine;
Alpine.plugin(ajax);

Alpine.plugin(focus);
Alpine.plugin(lightbox);

/**
 * If you imported Alpine into a bundle, you have to make sure you are
 * registering any extension code IN BETWEEN when you import the Alpine
 * global object, and when you initialize Alpine by calling Alpine.start().
 */
Alpine.start();

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
