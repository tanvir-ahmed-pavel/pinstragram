<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = User::findOrFail($id)->profile;

        return response()->json([
            'profile' => $profile,
        ], 200);
    }

    public function profilePost($id){
        $posts = User::findOrFail($id)->posts()->orderBy("created_at", "desc")->with('user.profile')->get();

        return response()->json([
            'posts' => $posts,
        ], 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            "title" => "string|nullable",
            "description" => "string|nullable",
            "profile_img" => "image|nullable",
            "url" => "url|nullable",
        ]);



        $user = User::findOrFail($id);

        if ( Auth::user()->id == $user->profile->user_id) {
            if ($data['profile_img']) {
                $img_path = $request->file("profile_img")->store("profile_imgs", 'public');
                $user->profile()->update([
                    "title" => $data["title"],
                    "url" => $data["url"],
                    "description" => $data["description"],
                    "profile_img" => $img_path,
                ]);
            } else {
                $user->profile()->update([
                    "title" => $data["title"],
                    "url" => $data["url"],
                    "description" => $data["description"],
                ]);
            }
            return response()->json('success', 200);
        }
        return response()->json('Server error', 500);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
