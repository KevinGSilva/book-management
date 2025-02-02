<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookRepository
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function getBook(): Book
    {
        return $this->book;
    }

    public function store(array $data): Book
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'author_id' => 'required',
            'published_at' => 'required|date',
            'description' => 'required',
            'cover' => 'mimes:jpg,jpeg,png|max:2048',
        ])->setCustomMessages([
            'title.required' => 'Campo nome é obrigatório',
            'author_id.required' => 'Campo autor é obrigatório',
            'published_at.required' => 'Campo data de publicação é obrigatório',
            'published_at.date' => 'Campo data de publicação deve ser uma data válida',
            'description.required' => 'Campo descrição é obrigatório',
            'cover.mimes' => 'Campo capa deve ser um arquivo do tipo: jpg, jpeg ou png',
            'cover.max' => 'Campo capa deve ter no máximo 2MB',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->book->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'author_id' => 'required',
            'published_at' => 'required|date',
            'description' => 'required',
            'cover' => 'mimes:jpg,jpeg,png|max:2048',
        ])->setCustomMessages([
            'title.required' => 'Campo nome é obrigatório',
            'author_id.required' => 'Campo autor é obrigatório',
            'published_at.required' => 'Campo data de publicação é obrigatório',
            'published_at.date' => 'Campo data de publicação deve ser uma data válida',
            'description.required' => 'Campo descrição é obrigatório',
            'cover.mimes' => 'Campo capa deve ser um arquivo do tipo: jpg, jpeg ou png',
            'cover.max' => 'Campo capa deve ter no máximo 2MB',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        
        $book = $this->book->find($id);

        return $book->update($data);
    }
}