<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Privacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $publicPost = Privacy::findOrFail(1)->posts->load(['user', 'user.profile', 'likedBy', 'likedBy.profile']);
//        $publicPost->likedBy->contains(Auth::user());

//        foreach ($publicPosts as $post){
//            $post->setAttribute("likedByAuth", $post->likedBy->contains(Auth::user()));
//            $publicPost = $publicPosts;
//        }

        $selfFrndPost = Auth::user()->posts->load(['user', 'user.profile', 'likedBy', 'likedBy.profile'])->where('privacy_id', 2);


        $followings = Auth::user()->followings->pluck('user_id');

//        i have to use pluck here *Oh i already did, xDD*
        $followingPost = Privacy::findOrFail(2)->posts->whereIn('user_id', $followings)->load(['user', 'user.profile', 'likedBy', 'likedBy.profile']);


        $posts = $publicPost->merge($selfFrndPost)->merge($followingPost)->sortByDesc('created_at')->values();


        return response()->json([
            'posts' => $posts,
        ]);



//        Old & unoptimized code for reference

//        foreach (Privacy::findOrFail(1)->posts as $post)
//        {
//            $post->setAttribute("likedByAuth", $post->likedBy->contains(Auth::user()));
//
//            $post->user;
//            $post->user->profile;
//            $post->likedBy->load('profile');
//            $publicPost[] = $post;
//        }
//
//        foreach (Privacy::findOrFail(2)->posts as $post)
//        {
//            if ($post->user->id == Auth::user()->id)
//            {
//                $post->setAttribute("likedByAuth", $post->likedBy->contains(Auth::user()));
//
//                $post->user;
//                $post->user->profile;
//                $post->likedBy->load('profile');
//                $selfPost[]=$post;
//            }
//        }
//
//        $followings = Auth::user()->following;
//        foreach ($followings as $following)
//        {
//            foreach ($following->user->posts as $post)
//            {
//                if ($post->privacy_id == 2)
//                {
//                    $post->setAttribute("likedByAuth", $post->likedBy->contains(Auth::user()));
//                    $post->user;
//                    $post->user->profile;
//                    $post->likedBy->load('profile');
//                    $friendsPost[]=$post;
//                }
//            }
//        }
//
//        $unsortedPosts = array_merge($publicPost, $selfPost, $friendsPost);
//        $posts = collect($unsortedPosts)->sortByDesc('created_at')->values();
//
//        return response()->json([
//            'posts' => $posts,
//        ]);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "content" => "required_without_all:img|string|nullable",
            "img" => "required_without_all:content|image|nullable",
            "privacy_id" => "required|int",
        ]);

        $user = Auth::user();


        $img_path = $request->file("img");
        if (!is_null($img_path)) {
            $img_path = $request->file("img")->store("post_imgs", 'public');
            $user->posts()->create([
                "content" => $data['content'],
                "privacy_id" => $data['privacy_id'],
                "img" => $img_path,
            ]);
            return response()->json('Post Created', 200);
        } else {
            $user->posts()->create([
                "content" => $data['content'],
                "privacy_id" => $data['privacy_id'],
            ]);

//            $post->privacy()->attach($privacy->id);
//            $instantLoad = $this->index();

            return response()->json("Post Created", 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->user;
        $post->user->profile;

        return response()->json([
            'post' => $post,
        ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $this->validate($request, [
            "content" => "string|nullable",
            "privacy_id" => "required",
        ]);
        $post = Post::findOrFail($id);

        if (Auth::user()->id === $post->user->id){
            $post->update($data);
            return response()->json('',200);
        }
        return response()->json('',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user->id === Auth::user()->id){
            $post->delete();
            return response()->json('Post Deleted', 200);
        }
        return response()->json('', 401);
    }
}
