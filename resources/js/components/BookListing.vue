<template>
    <div class="div">
        <header class="hero-section">
            <div class="hero-content">
                <h1>Book Shop</h1>
                <p>
                    Cupcake ipsum dolor sit amet croissant. I love topping candy
                    canes sweet roll croissant caramels. Soufflé macaroon
                    liquorice chocolate tart I love.
                </p>
            </div>
        </header>

        <main class="main-section">
            <div class="search-bar">
                <input
                    type="text"
                    v-model="query"
                    @input="search"
                    placeholder="Search..."
                />
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
                    <tr v-for="(book, index) in results" :key="index">
                        <td>{{ book.title }}</td>
                        <td>{{ book.author }}</td>
                        <td>{{ book.rating }}</td>
                        <td>
                            <div class="action-buttons">
                                <!-- <EditBook :book="book" /> -->
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
import Meilisearch from "meilisearch";

export default {
    name: "BookListing",
    data() {
        return {
            query: "",
            client: null,
            results: [],
            allBooks: [],
        };
    },
    async mounted() {
        this.client = new Meilisearch({ host: "http://localhost:7700/" });
        await this.fetchAllBooks(); // Fetch all books and populate allBooks
        this.search(); // Initially, show all books
    },
    methods: {
        async fetchAllBooks() {
            // Fetch all books from the Meilisearch index
            try {
                const response = await this.client.index("books").search("");
                this.allBooks = response.hits;
            } catch (error) {
                console.error("Error fetching books:", error);
            }
        },
        async search() {
            if (this.query) {
                const response = await this.client
                    .index("books")
                    .search(this.query);
                this.results = response.hits;
                console.log(this.results);
            } else {
                // If the search query is empty, show all the books
                this.results = this.allBooks;
            }
        },
    },
};
</script>

<style>
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
    font-size: 16px;
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
