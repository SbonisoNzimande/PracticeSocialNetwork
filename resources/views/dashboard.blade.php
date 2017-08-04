@extends('layouts.master')

@section('title')
    Dashboard
@endsection
@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say</h3></header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder=""></textarea>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}"> <!-- prevent crossite scripting -->
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What others said</h3></header>
            @foreach($posts as $post)
                <article class="post">
                    <p>
                        {{ $post->body }}
                    </p>
                    <div class="info">
                        Posted By {{ $post->user->firstname }} on {{ $post->created_at->diffForHumans() }}
                    </div>
                    <div class="interaction">
                        <a href="#">Like</a> |
                        <a href="#">Dislike</a> |
                        <a href="#">Edit</a> |
                        <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                    </div>
                </article>
            @endforeach

        </div>
    </section>
@endsection