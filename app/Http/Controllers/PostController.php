<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$post = Post::all();
        $post = Post::latest()->paginate(10);
        return view('post.index', compact('post'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required',
        ]);

        Post::create([
            'content' => $request->content,
            'tags' => $request->tags,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('post.index')
            ->with('success', 'Post ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatePost = $request->validate([
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required',
        ]);
        Post::whereId($id)->update($updatePost);
        return redirect()->route('post.index')
            ->with('success', 'Le post mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/post')->with('success', 'Post supprimé avec succès');
    }
}
