<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function isFollowing($id){
        $profile = User::findOrFail($id)->profile;
        $following = Auth::user()->following->contains($profile);

//        dd($following);
        return $following;
    }

    public function store($id){
        $profile = User::findOrFail($id)->profile;

        return Auth::user()->following()->toggle($profile);
    }

}
