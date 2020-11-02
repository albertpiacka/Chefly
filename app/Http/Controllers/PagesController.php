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
        return view('master', [
            'title' => 'Chefly',
            'posts' => Post::all()
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'We suck a lot!'
        ]);
    }

    public function contact()
    {
        return 'contact page';
    }

    public function dudes()
    {
        return 'dudes page';
    }
}
