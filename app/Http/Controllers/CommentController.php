<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$post = Post::all();
        $comment = Comment::latest()->paginate(10);
        return view('comment.index', compact('comment'));
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comment.create');
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

        Comment::create([
            'content' => $request->content,
            'tags' => $request->tags,
            'image' => $request->image,
            'user_id' => Auth::user()->id,
            'post_id'=> Auth::user()->id,
            //'post_id'=> $request->post_id,
        ]);

        return redirect()->route('comment.index')
            ->with('success', 'Commentaire ajouté avec succès !');
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
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateComment = $request->validate([
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required',
        ]);
        Comment::whereId($id)->update($updateComment);
        return redirect()->route('comment.index')
            ->with('success', 'Le commentaire a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect('/comment')->with('success', 'commentaire supprimé avec succès');
    }
}
