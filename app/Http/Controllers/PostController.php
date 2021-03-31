<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->with('user')->get();

        // $pos = Post::find(1);
        // dd($pos->titre);

        return Inertia::render('Posts/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'titre' => 'required|string|min:5',
            'commentaire' => 'required|string|min:10',
            'image' => 'required|mimes:jpg,jpeg,png,svg|max:2048'
         ]);


        $image_path = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'titre' => $request->titre,
            'commentaire' => $request->commentaire,
            'image' => $image_path
        ]);

        return Redirect::route('dashboard') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Int $id)
    {
        $post = Post::where('id', $id)->with(['comments','user'])->first();

        

        return Inertia::render('Posts/Comment', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, int $id)
    {
        $post = Post::find($id);

        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Int $id)
    {
        $post = Post::find($id);



        $request->validate([
            'titre' => 'required|string|min:5',
            'commentaire' => 'required|string|min:10',
            'image' => 'sometimes',
         ]);
 

         if($request->image != "null" )
         {  
            $image_path = request('image')->store('uploads', 'public');

            $post->update([
                'titre' => $request->titre,
                'commentaire' => $request->commentaire,
                'image' => $image_path
            ]);
         }
         else{

            $post->update([
                'titre' => $request->titre,
                'commentaire' => $request->commentaire
            ]);
            
         }

         return redirect()->back();
    }


    public function list()
    {
        $posts = Post::orderBy('created_at', 'DESC')->with('user')->get();

        return Inertia::render('Posts/Liste', [
            'posts' => $posts,

            // pour les paraùetre de connection

            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back();
    }
}
