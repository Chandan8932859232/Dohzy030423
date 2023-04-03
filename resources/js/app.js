
require('./bootstrap');

import router from "./routes";
import VueRouter from "vue-router";
import  Index from "./Index";

window.Vue = require('vue');

Vue.use(VueRouter); // allows every component of the application to have access to the router and route

const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index
    }
});
