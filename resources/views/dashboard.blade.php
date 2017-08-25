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
                        <a href="#">Dislike</a>

                        @if(Auth::user() == $post->user)
                            |
                            <a href="#edit-modal" class="edit" data-post-id="{{ $post->id }}" data-post-body="{{ $post->body }}"  data-toggle="modal">Edit</a>
                            |

                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach

        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form  method="post">
                        <div class="form-group">
                            <textarea class="form-control" name="post-body" id="post-body" rows="5" placeholder=""></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('post.edit') }}';
    </script>
@endsection