<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Http\Services\Book\Update;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_book()
    {
        // Create a book to be updated and prepare the data for update.
        $bookToUpdate = Book::factory()->create();
        $newBookData = [
            'title' => 'New Book Title',
            'author' => 'New Author',
            'rating' => 5,
        ];

        // Bind the closure to the container as a fake Update service implementation.
        $this->app->bind(Update::class, function ($app) use ($bookToUpdate) {
            return new class($bookToUpdate) extends Update
            {
                private $book;

                public function __construct(Book $book)
                {
                    $this->book = $book;
                }

                public function __invoke(array $data, Book $book): Book
                {
                    // Return the same book instance.
                    return $this->book;
                }
            };
        });

        // Call the update method through a simulated HTTP request.
        $response = $this->json('PUT', "/books/{$bookToUpdate->id}", $newBookData);

        // Check the JSON response for the correct message and book data.
        $response->assertStatus(200); // Return HTTP status 200 on successful updates.
        $response->assertJson([
            'message' => 'Successfully updated the book.',
            'data' => $bookToUpdate->toArray(),
        ]);
    }
}
