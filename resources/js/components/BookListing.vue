<template>
<div class="div">
        <header class="hero-section">
            <div class="hero-content">
                <h1>Book Shop</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit</p>
            </div>
        </header>

        <main class="main-section">
            <div class="search-bar">
                <input type="text" placeholder="Search..." v-model="search">
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="title-column">Title</th>
                        <th class="author-column">Author</th>
                        <th>Rating</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sample Book 1</td>
                        <td>Author 1</td>
                        <td>4.5</td>
                        <td>
                            <div class="action-buttons">
                                <a href="">Edit</a>
                                <a href="">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
</div>

</template>

<script>
import { onMounted, watchEffect } from "Vue";
// import Meilisearch from "meilisearch";
    export default {
        name: 'BookListing',
    }
    // import {onMounted, watchEffect} from "Vue";
    // import Meilisearch from "meilisearch";
    // const query = ref("");
    // const client = ref(null);
    // const results = ref(null);
    // const selectedHitIndex = ref(0);


    // onMounted(() => {
    //     client.value = new Meilisearch({host: "http://localhost:3000/"})
    // });
</script>

<style>
/* Reset some default styles to avoid unexpected behavior */
body,
h1,
p,
table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
}

/* Hero Section Styles */
.hero-section {
    background-color: #1f2937;
    padding: 40px;
    height: 300px;
    display: flex; /* Use flexbox to center the content */
    justify-content: center; /* Horizontally center the content */
    align-items: center; /* Vertically center the content */
    text-align: center;
}

.hero-content {
    max-width: 600px;
}
.hero-content h1 {
    color: #e94422;
    font-size: 50px;
    font-weight: bold;
}
.hero-content p {
    color: #fff;
    padding-top: 15px;
}
/* Main Section Styles */
.main-section {
    padding: 20px;
    max-width: 78%;
    margin: 0 auto;
}

/* Search Bar Styles */
.search-bar {
    text-align: right;
    margin-bottom: 20px;
}

.search-bar input[type="text"] {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 30%;
}

/* Table Styles */
.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: 10px;
    border: 2px solid #fff;
}
.title-column {
    width: 85%;
}
.author-column {
    width: 15%;
}
.data-table th {
    background-color: #1f2937;
    color: #fff;
    /* background-color: #f0f0f0; */
    font-weight: bold;
}

.data-table td {
    background-color: #d1d5db;
    color: #000;
}

.action-buttons a {
    display: block; /* Make the buttons appear in separate lines */
    margin-top: 5px; /* Optional: Add some spacing between the buttons */
    color: #000;
    font-weight: bold;
}

</style>
