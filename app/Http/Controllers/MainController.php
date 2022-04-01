<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home(){
        $posts = new Post();
        return view('home', ['posts' => $posts->all()]);
    }

    public function about(){
        return view('about');
    }

    public function message(){
        if(Auth::check()){
            return view('message');
        }else{
            return redirect(route('user.login'))->withErrors([
                'messageError' => 'Войдите, чтобы публиковать посты'
            ]);
        }
    }

    public function comment_post(Request $request){
        $valid = $request->validate([
            'message' => 'required'
        ]);
        $comment = new Comment($valid);
        $comment->user_id = Auth::id();
        $comment->post_id = $request->postId;
        $comment->save();
        return redirect()->route('home');
    }

    public function message_check(Request $request)
    {
        $valid = $request->validate([
            'theme' => 'required|min:5|max:60',
            'message' => 'required|min:5|max:150'
        ]);

        $post = new Post($valid);
        $post->user_id = Auth::id();
        $post->likes = 0;
        if($request->hasFile('file'))
        {   
            $post->addMedia($request->file('file'))->toMediaCollection('media');
        };
        $post->save();

        return redirect()->route('message');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
