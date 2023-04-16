<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function add(Request $request, Website $website) {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $request->merge([
            'website_id' => $website->id
        ]);

        $post = Post::create($request->all());
        return response()->json(new PostResource($post));
    }
}
