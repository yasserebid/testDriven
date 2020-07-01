<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {

        Book::create($this->validateData());
    }

    public function update(Book $book)
    {

        $book->update($this->validateData());
    }
    public function validateData()
    {
        return request()->validate([
            "title" => 'required',
            "auther" => 'required',
        ]);
    }
}
