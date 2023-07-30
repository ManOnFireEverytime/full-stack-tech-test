<template>
    <div>
        <div class="bg-gray-800 pt-8 pb-20">
            <div class="w-9/12 text-center mr-auto ml-auto -mt-0 mb-0">
                <h1 class="text-orange text-5xl p-10">Book Shop</h1>
                <p class="w-9/12 mr-auto ml-auto -mt-0 mb-0 text-white">
                    Cupcake ipsum dolor sit amet croissant. I love topping candy
                    canes sweet roll croissant caramels. Soufflé macaroon
                    liquorice chocolate tart I love.
                </p>
            </div>
        </div>
        <div class="w-1/5 text-left mr-auto ml-auto -mt-0 mb-0">
            <form @submit.prevent="updateBook">
                <div class="pt-10">
                    <h2 class="text-center text-3xl pb-10">Edit Book</h2>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Title: </label>
                        <input
                            type="text"
                            v-model="editedBook.title"
                            placeholder="Title"
                            class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96"
                        />
                    </div>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Author: </label>
                        <input
                            type="text"
                            v-model="editedBook.author"
                            placeholder="Author"
                            class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96"
                        />
                    </div>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Rating: </label>
                        <input
                            type="text"
                            v-model="editedBook.rating"
                            placeholder="5"
                            class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96"
                        />
                    </div>
                </div>
                <div class="text-center">
                    <button
                        class="text-white bg-orange py-2 px-4 rounded"
                        type="submit"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Meilisearch from "meilisearch";

export default {
    name: "EditBook",
    data() {
        return {
            client: null,
            editedBook: {
                title: "",
                author: "",
                rating: "",
            },
        };
    },
    async mounted() {
        this.client = new Meilisearch({ host: "http://localhost:7700/" });
        await this.fetchBookData(); // Fetch book data and populate editedBook
    },
    methods: {
        async fetchBookData() {
            const bookId = this.$route.params.id.toString();
            try {
                const response = await this.client
                    .index("books")
                    .search(bookId, {
                        attributesToRetrieve: ["title", "author", "rating"],
                        limit: 1,
                    });

                if (response.hits.length > 0) {
                    this.editedBook = response.hits[0];
                } else {
                    console.error("Book not found.");
                }
            } catch (error) {
                console.error("Error fetching book data:", error);
            }
        },
        async updateBookData(updatedBook) {
            try {
                // Update the book document in the Meilisearch index
                await this.client.index("books").updateDocuments([updatedBook]);
            } catch (error) {
                console.error("Error updating book:", error);
                throw error;
            }
        },
        updateBook() {
            // Submit the updated book data to Meilisearch
            this.updateBookData(this.editedBook)
                .then(() => {
                    console.log(
                        "Book data updated successfully in Meilisearch!"
                    );
                    // Navigate back to the book listing page after successful submission
                    this.$router.push({ path: "/" });
                })
                .catch((error) => {
                    console.error("Error updating book:", error);
                    alert("Failed to update book, Please try again.");
                });
        },
    },
};
</script>
