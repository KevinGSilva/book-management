<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthorRepository
{
    private $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function store(array $data): Author
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->author->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        $book = $this->author->find($id);

        return $book->update($data);
    }
}