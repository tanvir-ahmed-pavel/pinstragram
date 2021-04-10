<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    public function store($id){
        $profile = User::findOrFail($id)->profile;

        return response()->json(Auth::user()->followings()->toggle($profile));
    }

    public function authFollowings(){
        $followings = Auth::user()->followings->load(['user']);

        return response()->json([
            'followings' => $followings,
        ]);
    }

}
