<?php

namespace App\Repositories;

use App\Models\Author;

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
}