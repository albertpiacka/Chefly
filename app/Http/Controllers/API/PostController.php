<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
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
        return Post::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->user_id;
        if(User::find($id)->type == 1 || User::find($id)->type == 2)
        {
            $request->validate([
                'title' => 'required',
                'slug' => 'required|unique:posts',
                'text' => 'required',
                'user_id' => 'required|integer|exists:users,id'
            ]);
    
            $post = Post::create($request->all());
      
            return response()->json([
                'message' => 'Post created',
                'post' => $post,
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('comments.user', 'user');
  
        return $post;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->authorize('update', $post);

        $request->validate([
            'slug' => "required|unique:posts,slug,{$id}",
            'text' => 'required',
            'title' => 'required'
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text
        ]);

        return response()->json([
            'message' => 'Post updated',
            'post' => $post,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->comments()->forceDelete();
        $post->forceDelete();

        return response()->json([
            'message' => 'Post deleted',
            'post' => $post,
        ], 200);
    }
}
