<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use App\Post;
use App\Quickpost;
use App\Comment;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.users', [
            'users' => User::all(),
            'title' => 'Users',
            'tags' => Tag::latest()->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::user()){
            if(Auth::user()->id == $user->id){
                return redirect('/profile');
            } else {
                return view('users.show', [
                    'user' => $user,
                    'tags' => Tag::latest()->get(),
                ]);
            }
        } else {
            return view('users.show', [
                'user' => $user,
                'tags' => Tag::latest()->get(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->file !== null){
            $exploded = explode(',', $request->file);

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else 
                $extension = 'png';

            $filename = str_random().'.'.$extension;

            $user->update([
                'name' => $request->name,
                'about' => $request->about,
                'image' => $filename,
            ]);

            $destinationPath = public_path();
            File::delete($destinationPath."/users-images/$request->oldImg");

            $filepath = public_path().'/users-images/'.$filename;

            file_put_contents($filepath, $decoded);

            return $filename;
        } else {
            $user->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
