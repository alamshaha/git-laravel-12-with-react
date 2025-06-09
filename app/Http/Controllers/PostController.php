<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        return Inertia::render('posts/index', [
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Post::create([
            'title'   => $request->title,
            'content' => $request->content,
             'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return Inertia::render('posts/edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
           
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
