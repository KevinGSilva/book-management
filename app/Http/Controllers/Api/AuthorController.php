<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = $this->authorRepository->getAuthor()->get()->values();

        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->authorRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->authorRepository->getAuthor()->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->authorRepository->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->authorRepository->deleteWithoutBook($id);
    }
}
