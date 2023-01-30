<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(20);
        
        return response()->json([
            'status' => true,
            'posts' => "Posts List",
            'data' => $posts
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
    public function store(StorePostRequest $request)
    {
        $product = Post::create($request->all());
        
        return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            "data" => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        if (is_null($post)) {
             return response()->json([
                "error" => true,
                "message" => "post not found.",
                "data" => []
            ],404);
        }
        return response()->json([
            "success" => true,
            "message" => "post retrieved successfully.",
            "data" => $post
        ],200);
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
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->save();

        return response()->json([
            "success" => true,
            "message" => "post updated successfully.",
            "data" => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            "success" => true,
            "message" => "post deleted successfully.",
            "data" => $post
        ]);
    }
}