<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        $post = new Post();
        return view('home', ['posts' => $post->all()]);
    }

    public function about(){
        return view('about');
    }

    public function message(){
        return view('message');
    }

    public function message_check(Request $request)
    {
        $valid = $request->validate([
            'theme' => 'required|min:5|max:60',
            'message' => 'required|min:5|max:150'
        ]);

        $post = new Post();
        if($request->hasFile('file'))
        {   
            $post->addMedia($request->file('file'))->toMediaCollection('media');
        };
        $post->theme = $request->theme;
        $post->message = $request->message;
        
        $post->save();

        return redirect()->route('message');
    }
}
