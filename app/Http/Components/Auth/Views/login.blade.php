@extends('..\..\..\..\..\layouts.app')
@section('title', 'Register User')

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ get_resource_path('css') }}">
@endsection
@section('content')
    <form action="{{action('Auth\Controllers\LoginController@login')}}" style="border:1px solid #ccc" method="post">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('alert-success'))
            <div class="alert alert-success">
                {{ session()->get('alert-success') }}
            </div>
        @endif
        @csrf
        <div class="container">
            <h1>Sign In</h1>
            <p>Please fill in this form.</p>
            <hr>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="psw-repeat"><b>Password</b></label>
            <input type="password" placeholder="password" name="password" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

            <div class="clearfix">
                <button type="submit" class="signupbtn">Sign In</button>
            </div>
        </div>
    </form>

@endsection
