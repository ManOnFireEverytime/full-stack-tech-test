<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\DestroyRequest;
use App\Http\Requests\Book\IndexRequest;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Requests\Book\AttachGenresRequest;
use App\Http\Services\Book\Destroy;
use App\Http\Services\Book\Index;
use App\Http\Services\Book\Store;
use App\Http\Services\Book\Update;
use App\Http\Services\Book\AttachGenres;
use App\Models\Book;

class BookController extends Controller
{
    public function index(IndexRequest $request, Index $index)
    {
        return response()->json([
            'message' => 'Successfully fetched the books.',
            'data' => $index()
        ]);
    }
    protected $AttachGenres;

    public function __construct(AttachGenres $genreService)
    {
        $this->AttachGenres = $genreService;
    }
    public function attachGenres(AttachGenresRequest $request, Book $book)
    {
        $genreIds = $request->input('genres');

        // Attach genres to the book
        $book->genres()->sync($genreIds);

        return response()->json([
            'message' => 'Genres added to the book successfully.',
            'data' => $book->load('genres'),
        ]);
    }
    public function store(StoreRequest $request, Store $store)
    {
        $book = $store($request->validated());

        return response()->json([
            'message' => 'Successfully stored the book.',
            'data' => $book
        ]);
    }

    public function update(UpdateRequest $request, Update $update, Book $bookToUpdate)
    {
        $updatedBook = $update($request->validated(), $bookToUpdate);

        return response()->json([
            'message' => 'Successfully updated the book.',
            'data' => $updatedBook
        ]);
    }

    public function destroy(DestroyRequest $request, Destroy $destroy, Book $book)
    {
        $destroy($book);

        return response()->json([
            'message' => 'Successfully deleted the book.',
        ]);
    }
}
