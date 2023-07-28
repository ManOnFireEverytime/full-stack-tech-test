<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Update
{
    public function __invoke(array $data, Book $book): Book
    {
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
    }
}
