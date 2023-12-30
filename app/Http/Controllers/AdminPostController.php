<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class AdminPostController extends Controller
{
   public function index(){
    return view('admin.posts.index',[
        'posts'=> Post::paginate(50)
    ]);
   } 

   public function create(){
        
    // if(auth()->guest()){
    //     //abort(403);
    //     abort(Response::HTTP_FORBIDDEN);
    // }

    // if(auth()->user()->username != 'Mariammar'){
    //     abort(Response::HTTP_FORBIDDEN);
    // }//one admin case

    // if(auth()->user()?->username != 'Mariammar'){
    //     abort(Response::HTTP_FORBIDDEN);
    // } // to midllleware

    return view('admin.posts.create');
} 

public function store (){


    $attributes = request()->validate([
        'title'=> 'required',
        'thumbnail'=> 'required|image',
        'slug'=>  ['required', Rule::unique('posts', 'slug')],
        'excerpt'=> 'required',
        'body'=> 'required',
        'category_id'=> ['required', Rule::exists('categories', 'id')]
    ]);
    $attributes['user_id'] = auth()->id();
    $attributes['thumbnail']= request()->file('thumbnail')->store('thumbnails', 'public');
    Post::create($attributes);
    return redirect('/');
    }
    

public function edit(Post $post){
return view('admin.posts.edit',['post'=> $post]);
}


public function update(Post $post){
    $attributes = request()->validate([
        'title' => 'required',
        'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
        'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
        'excerpt' => 'required',
        'body' => 'required',
        'category_id' => ['required', Rule::exists('categories', 'id')]
    ]);
    
    if (isset($attributes['thumbnail'])) {
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
    }
    
    // $post->slug = $attributes['slug'];
    
    $post->update($attributes);
    
    return redirect('/')->with('success', 'Post Updated!!');
    
    }


    public function destroy(Post $post){
        $post->delete();
        return redirect('/')->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post=null){
        $post ??= new Post();

        return  request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'published_at'=>'required'
        ]);
    }
}
