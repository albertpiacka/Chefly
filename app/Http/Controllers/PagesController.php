<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('index', [
            'title' => 'Chefly',
            'posts' => Post::all()
        ]);
    }
}
