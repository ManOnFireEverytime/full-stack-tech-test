import "./bootstrap";
// import Vue from "vue";

/**
 * Vue Components
 *
 * The individual elements of the Cerberus UI. These are all individually loaded on a page by
 * page basis to reduce bundle size and prevent loading unwanted components on each page.
 *
 */

/**
 * Bootstrapping
 *
 * Build the Vue instance, import the Core Services at the point of creation and register all
 * of our Vue instance to the #root tag.
 */
// const app = new Vue({
//     el: "#app",
// });

import Vue from "vue";
import VueRouter from "vue-router";
// import App from "./App.vue";
import BookListing from "./components/BookListing.vue";
import EditBook from "./components/EditBook.vue";

Vue.component("BookListing", () => import("./components/BookListing.vue"));
Vue.component("EditBook", () => import("./components/EditBook.vue"));

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: BookListing,
    },
    {
        path: "/edit/:id", // Use a dynamic parameter (e.g., id) to pass book ID to EditBook
        name: "EditBook", // Give the route a name for easier navigation
        component: EditBook,
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

const app = new Vue({
    el: "#app",
    router,
    // render: (h) => h(app),
}).$mount("#app");
