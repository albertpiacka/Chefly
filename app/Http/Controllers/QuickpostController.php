<?php

namespace App\Http\Controllers;

use App\Quickpost;
use App\User;
use File;
use Illuminate\Http\Request;

class QuickpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'user_id' => 'required|integer|exists:users,id'
            ]);

            if ($request->image !== null) {
                $exploded = explode(',', $request->image);

                $decoded = base64_decode($exploded[1]);

                if(str_contains($exploded[0], 'jpeg'))
                    $extension = 'jpg';
                else 
                    $extension = 'png';

                $filename = str_random().'.'.$extension;

                $quickpost = Quickpost::create([
                    'text' => $request->text,
                    'user_id' => $request->user_id,
                    'file' => $filename,
                ]);

                $filepath = public_path().'/quickposts-images/'.$filename;

                file_put_contents($filepath, $decoded);
            } else {
                $quickpost = Quickpost::create([
                    'text' => $request->text,
                    'user_id' => $request->user_id,
                ]);
            }

            return response()->json([
                'message' => 'Post created',
                'quickpost' => $quickpost->load('user'),
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quickpost  $quickpost
     * @return \Illuminate\Http\Response
     */
    public function show(Quickpost $quickpost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quickpost  $quickpost
     * @return \Illuminate\Http\Response
     */
    public function edit(Quickpost $quickpost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quickpost  $quickpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quickpost $quickpost)
    {
        $quickpost->update([
            'file' => null,
        ]);

        $destinationPath = public_path().'/quickposts-images/';
        File::delete($destinationPath."$quickpost->file");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quickpost  $quickpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quickpost $quickpost)
    {
        //
    }
}
