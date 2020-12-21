<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CheckinBookController extends Controller
{
    //
    public function store(Book $book)
    {
        $book->checkin(auth()->user());
    }
}
