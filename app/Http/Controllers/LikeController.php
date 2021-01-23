<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store($id){
        $post = Post::finOrFail($id);

        return Auth::user()->likes()->toggle($post);

    }

    public function isLiked($id){
        $post = Post::findOrFail($id);

        return Auth::user()->likes->contains($post);
    }

}
