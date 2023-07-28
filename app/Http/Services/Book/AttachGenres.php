<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class AttachGenres
{
    public function attachGenres(Book $book, array $genreIds)
    {
        $book->genres()->sync($genreIds);
    }
}
