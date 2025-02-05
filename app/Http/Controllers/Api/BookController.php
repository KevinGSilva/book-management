<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookRepository->getBook()->get()->values()->map(function ($book) {
            $media = $book->getFirstMedia('cover');

            if ($media) {
                $book->cover_url = $media->getUrl('thumb');
            } else {
                $book->cover_url = null;
            }

            return $book;
        });

        if (request('withAuthor') == true) {
            $books->load('author');
        }

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->bookRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookRepository->getBook()->findOrFail($id);

        $media = $book->getFirstMedia('cover');

        if ($media) {
            $book->cover_url = $media->getUrl('thumb');
        } else {
            $book->cover_url = null;
        }

        return $book;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->bookRepository->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->bookRepository->getBook()->find($id)->delete();
    }
}
