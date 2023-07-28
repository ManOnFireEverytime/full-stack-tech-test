import "./bootstrap";
import Vue from "vue";
import { createRouter, createWebHistory } from "vue-router"; // Import Vue Router

// Vue Components
Vue.component("BookListing", () => import("./components/BookListing.vue"));
Vue.component("EditBook", () => import("./components/EditBook.vue"));

// Create Vue Router instance and define routes
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: () => import("./components/BookListing.vue") },
        {
            path: "/edit/:id",
            component: () => import("./components/EditBook.vue"),
        },
    ],
});

// Mount the Vue instance and attach the router
const app = new Vue({
    router, // Attach the router to the Vue instance
}).$mount("#app");
