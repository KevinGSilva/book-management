<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Services\ApiImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    private $bookRepository;
    private $apiImagesService;

    public function __construct(BookRepository $bookRepository, ApiImagesService $apiImagesService)
    {
        $this->bookRepository = $bookRepository;
        $this->apiImagesService = $apiImagesService;
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
        DB::beginTransaction();

        try {
            $book = $this->bookRepository->store($request->except('cover'));
    
            if ($book) {
                if ($request->get('cover')) {
                    $this->apiImagesService->decodeImageBase64($book, $request->get('cover'));
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $book;
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
        DB::beginTransaction();
        try {
            $book = $this->bookRepository->update($id, $request->except('cover'));

            if ($book) {
                if ($request->get('cover')) {
                    $updatedBook = $this->bookRepository->getBook()->find($id);
                    $this->apiImagesService->decodeImageBase64($updatedBook, $request->get('cover'));
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->bookRepository->getBook()->find($id)->delete();
    }
}
