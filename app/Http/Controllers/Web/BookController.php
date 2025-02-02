<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookRepository;
    private $authorRepository;

    public function __construct(BookRepository $bookRepository, AuthorRepository $authorRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->bookRepository->getBook()->get()->values();

        return view('web.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book = $this->bookRepository->getBook();
        $authors = $this->authorRepository->getAuthor()
                ->where('status', 1)
                ->get()->values();

        return view('web.books.form', compact('book', 'authors'), ['action' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return [
            'success' => true,
            'book' => $this->bookRepository->store($request->all()),
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->bookRepository->getBook()->find($id);
        $authors = $this->authorRepository->getAuthor()
                ->where('status', 1)
                ->get()->values();

        return view('web.books.form', compact('book', 'authors'), ['action' => 'update']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return [
            'success' => true,
            'book' => $this->bookRepository->update($request->get('id'), $request->all()),
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return [
            'success' => true,
            'book' => $this->bookRepository->getBook()->find($request->get('id'))->delete()
        ];
    }
}
