<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$post = Post::all();
        $posts = Post::latest()->paginate(10);
        $comments = Comment::all();
       // return view('home', compact('post','comment'));

        return view("home", [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
