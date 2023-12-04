<?php
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

use App\Http\Controllers\RigisterController;
use App\Http\Controllers\SessionsController;

  //$posts = Post::all();
  //ddd($posts);
  //ddd($posts[0]->getPathname());
  //ddd((string)$posts[0]); same as get path name
  //ddd($posts[0]->getContents());
  //ddd($posts);





 // {  $document =  YamlFrontMatter::parseFile(
 //   resource_path('posts/Fourth-Post.html')
 //  );
 // ddd($document);
 // ddd($document->body());
 //ddd($document->matter());
 //ddd($document->matter('title'));
 //ddd($document->title);
 // ddd($document->excerpt);
 // ddd($document->date);

  //  return view('posts',[
  //'posts' => Post::all()]);}



/*
  $posts = [] ; 
  $files = File::files(resource_path("posts/"));//fetch al files in post dir
   foreach ($files as $file) {
    $document = YamlFrontMatter::parseFile($file);
    $posts[] = new Post(
      $document->title ,
      $document->excerpt,
      $document->date,
      $document->body(),
      $document->slug
      );
     
   //ddd($posts);
   //ddd($document);    this this an document object 
    } 
   */

 // DB::listen(function ($query)  {
  //  logger($query->sql);
    
 // });
   

 Route::get('/', [PostController::class, 'index'] )->name('home');

 Route::get('posts/{post:slug}', [PostController::class, 'show'] );

 Route::get('register', [RigisterController::class,'create'])->middleware('guest');
 Route::post('register', [RigisterController::class,'store'])->middleware('guest');
 Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
 Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
 Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');
/*Route::get('posts/{post:slug}', [PostController::class, 'show']) ;
  
  Route::get('categories/{category:slug}', function (Category $category)  { 
    return view('posts',[
      'posts' =>  $category->posts,
       'currentCategory' => $category,
      'categories' => Category::all()
    ]);
  })->name('category');
*/

  /*Route::get('authors/{author:username}', function (User $author)  { 
    return view('posts.index',[
      'posts' =>  $author->posts 
    ]);
      
  });*/