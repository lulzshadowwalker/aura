import axios from "axios";

import Alpine from "alpinejs";
import ajax from "@imacrayon/alpine-ajax";

window.Alpine = Alpine;
Alpine.plugin(ajax);

/**
 * If you imported Alpine into a bundle, you have to make sure you are
 * registering any extension code IN BETWEEN when you import the Alpine
 * global object, and when you initialize Alpine by calling Alpine.start().
 */
Alpine.start();

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
