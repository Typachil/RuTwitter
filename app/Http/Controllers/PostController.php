<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function commentPost(Request $request){
        $valid = $request->validate([
            'message' => 'required'
        ]);
        $comment = new Comment($valid);
        $comment->user_id = Auth::id();
        $comment->post_id = $request->postId;
        $comment->save();
        return redirect()->route('home');
    }

    public function messageCreate(Request $request)
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

    public function showOneMessage($id){
        $post = new Post();
        return view('onemessage', ['data' => $post->find($id)]);
    }

    public function editOneMessage($id, Request $request){
        $valid = $request->validate([
            'theme' => 'required|min:5|max:60',
            'message' => 'required|min:5|max:150'
        ]);

        $post = Post::find($id);
        $post->update($valid);
        $post->save();

        return redirect()->route('user.private')->with('status', 'Пост успешно обновлен');
    }

    public function delOneMessage($id){
        Comment::where('post_id', $id)->delete();
        Post::find($id)->delete();
        return redirect()->route('user.private')->with('status', 'Пост успешно удален');
    }
}
