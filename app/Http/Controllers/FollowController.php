<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
use App\Events\FollowSent;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        
        $follow = $user->followers()->create([
            'user_id' => $request->user_id,
            'follower_id' => $request->follower_id,
        ]);

        $following = User::findOrFail($request->user_id);
        
        return response()->json([
            'message' => 'Following '.$following->name,
            'follow' => $follow,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        $follow->delete();

        return response()->json([
            'message' => 'Unfollowed',
        ], 200);
    }
}
