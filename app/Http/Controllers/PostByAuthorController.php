<?php


namespace App\Http\Controllers;


class PostByAuthorController
{
    public function __invoke($id){
     $posts = \App\Models\Post::where('user_id',$id)->paginate(15);


      return view('pages.index', compact('posts'));
    }

}
