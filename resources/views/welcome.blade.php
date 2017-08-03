@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @if(count($errors) > 0)
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <form action="{{ URL('signup') }}" method="post">
                <h3>Sign Up</h3>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your Email</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{ Request::old('email') }}">
                </div>
                <div class="form-group  {{ $errors->has('firstname') ? 'has-error' : '' }}">
                    <label for="firstname">Your First Name</label>
                    <input class="form-control" type="text" id="firstname" name="firstname" value="{{ Request::old('firstname') }}">
                </div>
                <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" value="{{ Request::old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"> <!-- prevent crossite scripting -->
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('signin') }}" method="post">
                <h3>Sign In</h3>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input class="form-control" type="text" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"> <!-- prevent crossite scripting -->
            </form>
        </div>
    </div>
@endsection
