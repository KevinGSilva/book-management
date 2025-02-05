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
        ])->setCustomMessages([
            'name.required' => 'Campo nome é obrigatório',
            'status.required' => 'Campo status é obrigatório',
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
        ])->setCustomMessages([
            'name.required' => 'Campo nome é obrigatório',
            'status.required' => 'Campo status é obrigatório',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        $book = $this->author->find($id);

        return $book->update($data);
    }

    public function deleteWithoutBook(int $id): bool
    {
        $author = $this->author->find($id);

        if ($author->books()->count() > 0) {
            throw ValidationException::withMessages([
                'author' => ['Não é possível excluir um autor que possui livros.'],
            ]);
        }

        return $author->delete();
    }
}