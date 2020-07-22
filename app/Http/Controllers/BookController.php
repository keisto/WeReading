<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\Book\SearchFromRequest;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['search']]);
    }

    public function search(SearchFromRequest $request, BookService $bookService)
    {
        $books = $bookService->search($request->input, $request->index);

        if (is_int($books)) {
            return response()->json([
                'errors' => [
                    'root' => 'Uh oh! Something went wrong.'
                ]
            ], $books);
        }

        return response()->json([
            'data' => $books
        ], 200);
    }

    public function index()
    {
        return response()->json([
            'data' => request()->user()->books()->ordered()->get()
        ], 200);
    }

    public function show(Book $book)
    {
        return response()->json([
            'data' => $book
        ], 200);
    }

    public function store(Request $request)
    {
        $request->user()->books()->create(
            $request->only(['lookup_id', 'title', 'authors', 'image'])
        );

        return response()->json([
            'message' => 'Book Added'
        ], 200);
    }

    public function update(Request $request)
    {
        $books = array_values(Arr::sort($request->books, function ($book) {
            return $book['id'];
        }));

        $request->user()->books->each(function ($book, $index) use ($books) {
            $book->update(Arr::only($books[$index], ['sort_order']));
        });

        return response()->json([
            'message' => 'Books Updated'
        ], 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book Deleted'
        ], 200);
    }
}

