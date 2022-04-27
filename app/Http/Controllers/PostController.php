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

    public function messageLike($id, Request $request){
        $post = Post::find($id);
        foreach(json_decode($post->likes) as $key => $value){
            if($value == $request->userid){
                $likes = json_decode($post->likes);
                array_splice($likes, $key, 1);
                //$post->update(['likes' => json_encode($likes)]);
                $post->likes = $likes;
                $post->save();

                $data = ["likes_value" => count($likes)];
                return $data;
            }
        };
        $post->likes = array_merge(json_decode($post->likes), [$request->userid]);
        $post->save();

        $data = ["likes_value" => count($post->likes)];
        return $data;
    }

    public function messageCreate(Request $request)
    {
        $valid = $request->validate([
            'theme' => 'required|min:5|max:60',
            'message' => 'required|min:5|max:150'
        ]);

        $post = new Post($valid);
        $post->user_id = Auth::id();
        $post->likes = json_encode(array());
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

        return redirect()->route('user.private')->with('status', 'Пост успешно обновлен');
    }

    public function delOneMessage($id){
        Comment::where('post_id', $id)->delete();
        Post::find($id)->delete();
        return redirect()->route('user.private')->with('status', 'Пост успешно удален');
    }
}
