<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $profile = User::findOrFail($id)->profile;
        $profile->user;

        return response()->json([
            'profile' => $profile,
        ], 200);
    }

    public function profilePost($id)
    {

        $publicPost = [];
        foreach (Privacy::findOrFail(1)->posts->where('user_id', $id) as $post)
        {
            $post->user;
            $post->user->profile;
            $publicPost[] = $post;
        }


        $friendsPost = [];
        foreach (Privacy::findOrFail(2)->posts->where('user_id', $id) as $post)
        {
            $post->user;
            $post->user->profile;
            $friendsPost[] = $post;
        }

        if (Auth::user()->id == $id)
        {
            $posts = User::findOrFail($id)->posts()->orderBy("created_at", "desc")->with('user.profile')->get();

            return response()->json([
                'posts' => $posts,
            ], 200);
        }
        elseif (Auth::user()->following->contains(User::findOrFail($id)->profile))
        {
            $posts = array_merge($publicPost, $friendsPost);
            $posts = collect($posts)->sortByDesc('created_at')->values();

            return response()->json([
                'posts' => $posts,
            ], 200);
        }
        else
        {
            $posts = $publicPost;
            $posts = collect($posts)->sortByDesc('created_at')->values();

            return response()->json([
                'posts' => $posts,
            ], 200);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            "title" => "string|nullable",
            "description" => "string|nullable",
            "profile_img" => "image|nullable",
            "cover_img" => "image|nullable",
            "url" => "string|nullable",
        ]);


        $user = User::findOrFail($id);

        if (Auth::user()->id == $user->profile->user_id) {
            $p_img_path = $request->file("profile_img") ? $request->file("profile_img")->store("profile_imgs", 'public') : $user->profile->profile_img;
            $c_img_path = $request->file("cover_img") ? $request->file("cover_img")->store("cover_imgs", 'public') : $user->profile->cover_img;
            $title = $data["title"] ? $data["title"] : $user->profile->title;
            $url = $data["url"] ? $data["url"] : $user->profile->url;
            $description = $data["description"] ? $data["description"] : $user->profile->desciption;

            $user->profile()->update([
                "title" => $title,
                "url" => $url,
                "description" => $description,
                "profile_img" => $p_img_path,
                "cover_img" => $c_img_path,
            ]);
            return response()->json('success', 200);
        }
        return response()->json('unauthorized', 401);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
