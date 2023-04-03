import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent";
import Example2 from "./components/Example2";
import HelpComponent from "./components/pages/HelpComponent";

import HelpCenter from "./StaticPages/Help";
import AboutUs from "./StaticPages/About";
import Applications from "./FundsApplication/Applications";


const routes = [
    {
       path: "/",
       component: ExampleComponent,
       name:"home",
    },

    {
        path: "/second",
        component: Example2,
        name:"second",
    },
    /*
    {
        path: "/help",
        component: HelpComponent,
        name:"help",
    }, */

    {
        path: "/help",
        component: HelpCenter,
        name:"help",
    },

    {
        path: "/about",
        component: AboutUs,
        name:"about",
    },

    {
        path: "/applications",
        component: Applications,
        name:"applications",
    },

];


// Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's keep it simple for now.
const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history",
});

export default  router;  //export object router automatically from this file
