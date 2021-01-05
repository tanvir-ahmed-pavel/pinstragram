<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


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
        $posts = Post::orderBy("created_at", "desc")->with('user.profile')->get();

//        dd($posts);
        return response()->json([
            'posts' => $posts,
        ]);
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
        ]);

//        dd($request->img);

        $img_path = $request->file("img");
        if (!is_null($img_path)) {
            $img_path = $request->file("img")->store("post_imgs", 'public');
            Auth::user()->posts()->create([
                "content" => $data['content'],
                "img" => $img_path,
            ]);
            return response()->json('Post Created', 200);
        } else {
            Auth::user()->posts()->create([
                "content" => $data['content'],
            ]);
            return response()->json('Post Created', 200);
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
            "content" => "string|nullable"
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
