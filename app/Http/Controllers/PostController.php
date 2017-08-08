<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class PostController extends Controller
{
    //

    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get(); // fetch all posts in db
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

    public function getDeletePost ($post_id) {
        $post = Post::where('id', $post_id)->first();
        // check if post bellongs to current user
        if (Auth::user() != $post->user) {
            return redirect()->with(['message' => 'User Not logged']);
        }

        $post->delete();

        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }

    public function postEditPost(Request $request) {
        // Validation
        $this->validate($request, [
            'body' => 'required|max:100',
        ]);


        $post = Post::find($request['postId']);
        $post->body = $request['body'];
        $post->update();

        return response()->json(['message' => 'Post updated', 'new_body' => $post->body], 200);
    }
}
