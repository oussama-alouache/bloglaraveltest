<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Actions\PostUpdateAction;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::with('category', 'user')->latest()->get();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {    
        $imagename = $request->image->store ('posts');
         post::create ([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagename
        ]);

        return redirect()->route('dashboard')->with('success', 'Votre publication  a été créé');     
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }

        $categories = Category::all();

        return view('post.edit', compact('post', 'categories'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        
 
       
        $arrayupdate = [
            'title' => $request->title,
            'content' => $request->content
        ];
        if ($request-> image <> NULL  ){
            $imagename = $request->image->store ('posts');
            $arrayupdate = array_merge ($arrayupdate,[
                'image' => $imagename

              
            ]);
           $post->update($arrayupdate);
           return redirect()->route('dashboard')->with('success', 'Votre publication  a été modifer');     

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Gate::denies('delete-post', $post)) {
            abort(403);
        }

        $post ->delete();
        return redirect()->route('dashboard')->with('success', 'Votre publication  a été supprimer');     

    }
}
