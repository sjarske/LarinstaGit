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

        return request()->user()->posts;
    }

    public function store()
    {
        $this->authorize('create', Post::class);

        request()->user()->posts()->create($this->validateData());
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return $post;
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $post->update($this->validateData());
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
    }

    private function validateData(){
        return request()->validate([
            'caption' => 'required',
            'image' => 'required',
            'user_id' => '',        
            ]);
    }
}
