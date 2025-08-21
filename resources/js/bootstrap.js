import "./quicklink.js";
import axios from "axios";

import Alpine from "alpinejs";
import ajax from "@imacrayon/alpine-ajax";
import focus from '@alpinejs/focus'
import lightbox from 'alpine-tailwind-lightbox'
import posthog from 'posthog-js'

posthog.init(import.meta.env.VITE_POSTHOG_API_KEY,
    {
        api_host: import.meta.env.VITE_POSTHOG_API_HOST,
        person_profiles: 'always'
    }
)

window.Alpine = Alpine;
Alpine.plugin(ajax);

Alpine.plugin(focus)
Alpine.plugin(lightbox)

/**
 * If you imported Alpine into a bundle, you have to make sure you are
 * registering any extension code IN BETWEEN when you import the Alpine
 * global object, and when you initialize Alpine by calling Alpine.start().
 */
Alpine.start();

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
