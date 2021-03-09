<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Tag;
use File;
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
        return Post::with('likes', 'user')->latest()->get();
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
        if(User::find($id))
        {
            $request->validate([
                'title' => 'required',
                'slug' => 'required|unique:posts',
                'text' => 'required',
                'user_id' => 'required|integer|exists:users,id'
            ]);

            if($request->file == null){
                $post = Post::create([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'text' => $request->text,
                    'user_id' => $request->user_id,
                ]);
    
                foreach ($request->tags as $tag) {
                    $new_tag = Tag::firstOrCreate([
                        'tag' => $tag['tag'],
                    ]);
    
                    $post->tags()->save($new_tag);
                }

                return response()->json([
                    'message' => 'Post created',
                    'post' => $post,
                ], 201);
            } else {
                $exploded = explode(',', $request->file);

                $decoded = base64_decode($exploded[1]);

                if(str_contains($exploded[0], 'jpeg'))
                    $extension = 'jpg';
                else 
                    $extension = 'png';

                $filename = str_random().'.'.$extension;

                $post = Post::create([
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'text' => $request->text,
                    'user_id' => $request->user_id,
                    'image' => $filename,
                ]);

                foreach ($request->tags as $tag) {
                    $new_tag = Tag::firstOrCreate([
                        'tag' => $tag['tag'],
                    ]);

                    $post->tags()->save($new_tag);
                }

                $filepath = public_path().'/storage/posts-images/'.$filename;

                file_put_contents($filepath, $decoded);

                return response()->json([
                    'message' => 'Post created',
                    'post' => $post,
                ], 201);
            }
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
        $post->load('comments.user', 'user', 'tags');
  
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

        if ($request->file == null) {
            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'text' => $request->text
            ]);
        } else {
            $exploded = explode(',', $request->file);

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else 
                $extension = 'png';

            $filename = str_random().'.'.$extension;

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'text' => $request->text,
                'image' => $filename,
            ]);

            $filepath = public_path().'/storage/posts-images/'.$filename;

            file_put_contents($filepath, $decoded);

            $destinationPath = public_path().'/storage/posts-images/';
            File::delete($destinationPath."$request->old_img");
        }

        foreach ($request->tags as $tag) {

            if($tag['id'] == null){
                $new_tag = Tag::firstOrCreate([
                    'tag' => $tag['tag'],
                ]);
    
                $post->tags()->save($new_tag);
            }

        }

        foreach ($request->detached as $tag) {
            $post->tags()->detach($tag);
        }

        return response()->json([
            'message' => 'Post updated',
            'post' => $post->load('tags'),
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

        $destinationPath = public_path().'/storage/posts-images/';
        File::delete($destinationPath."$post->image");

        $post->comments()->forceDelete();
        $post->forceDelete();

        return response()->json([
            'message' => 'Post deleted',
            'post' => $post,
        ], 200);
    }
}
