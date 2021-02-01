<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home()
    {
        if (Auth::user()) {
            return view('home', [
                'date' => Carbon::now()->format('j F Y'),
                'tags' => Tag::latest()->get(),
                'following' => Auth::user()->following->load('user', 'user.posts', 'user.quickposts'),
            ]);
        } else {
            return view('index', [
                'title' => 'Chefly',
                'posts' => Post::with('comments', 'user')->latest()->get(),
            ]);   
        }
    }
}
