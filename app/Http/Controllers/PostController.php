<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function getDashboard()
    {
        $posts = Post::all(); // fetch all posts in db
        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {
        // Validation
        $this->validate($request, [
           'body' => 'required|max:100',
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        // save post to the logged in user user
        if ($request->user()->posts()->save($post)) {
            $message = 'Post was successfully created';
        }

        return redirect()->route('dashboard')->with(['message' => $message]);
    }
}
