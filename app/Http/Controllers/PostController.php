<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);

        return view('pages.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $post = new Post();

        return view('pages.form', compact('post'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->user_id = Auth::id();
        $post->save();

        return new RedirectResponse('/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     */
    public function show($id)
    {
       $post = Post::find($id);

        return view('pages.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     */
    public function edit(Post $post)

    {
        if ($this->authorize('update', $post)) {
            return view('pages.form', compact('post'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     *
     */
    public function update(Request $request, Post $post)
    {
       // $post->update($request->only('title', 'description'));
        if ($this->authorize('update', $post)) {
            $post->title = $request['title'];
            $post->description = $request['description'];
            $post->save();


            return redirect()->route('show', $post);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     *
     */
    public function destroy(Post $post)
    {
        if ($this->authorize('delete', $post)) {
            $post->delete();

            return redirect()->route('index');
        }
    }
}
