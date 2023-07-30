<?php

namespace App\Http\Services\Book;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Book;

class Update
{
    public function __invoke(array $data, Book $book): Book
    {
        try {
            if (!$book) {
                // If the book doesn't exist, throw a ModelNotFoundException.
                throw new ModelNotFoundException('Book not found.');
            }

            if (isset($data['title'])) {
                $book->title = $data['title'];
            }

            if (isset($data['author'])) {
                $book->author = $data['author'];
            }

            if (isset($data['rating'])) {
                $book->rating = $data['rating'];
            }

            $book->save();

            return $book;
        } catch (ModelNotFoundException $exception) {
            // Catch the exception and re-throw it, allowing Laravel to handle it appropriately.
            throw $exception;
        }
    }
}
