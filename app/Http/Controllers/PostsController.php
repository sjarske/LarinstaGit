<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;


class PostsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Post::class);

        return PostResource::collection( request()->user()->posts);
    }

    public function store()
    {
        $this->authorize('create', Post::class);

        $post = request()->user()->posts()->create($this->validateData());

        return (new PostResource($post))
        ->response()
        ->setStatusCode(201);
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return new PostResource($post);
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $post->update($this->validateData());

        return (new PostResource($post))
        ->response()
        ->setStatusCode(200);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response([], 204);
    }

    private function validateData(){
        return request()->validate([
            'title' => 'required',
            'caption' => 'required',
            'image' => 'required',
            'user_id' => '',        
            ]);
    }
}
