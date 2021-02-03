<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Tag;
use App\Comment;
use App\Bookmark;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.posts', [
            'title' => 'Posts',
            'posts' => Post::with('comments', 'user', 'likes', 'bookmarks')->latest()->get(),
            'tags' => Tag::latest()->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('comments', 'comments.user', 'likes', 'bookmarks');
        
        return view('posts.show', [
            'title' => $post->title,
            'post' => $post,
            'tags' => Tag::latest()->get(),
        ]);
    }
}
