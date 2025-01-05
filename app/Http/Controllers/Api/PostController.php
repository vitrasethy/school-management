<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Auth;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::all();

        $data = PostResource::collection($posts);

        return $this->successResponse($data);
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        $post = Post::create($validated);

        $data = new PostResource($post);

        return $this->successResponse($data, 201);
    }

    public function show(Post $post)
    {
        $data = new PostResource($post);

        return $this->successResponse($data);
    }

    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        $data = new PostResource($post);

        return $this->successResponse($data);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return $this->noContentResponse();
    }
}
