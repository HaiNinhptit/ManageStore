@extends('layouts.home')
@section('content')
    <div class="content" style="border: 1px solid grey;border-radius: 25px; width:600px; margin-left:300px;">
        <h2 style="color:red; margin-bottom:50px;margin-left: 200px;">REGISTER</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br />
        @endif
        <form class="form-horizontal" method="post" action="{{action('UserController@store')}}">
        {{csrf_field()}}
       
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-7">
            <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-7">
            <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" style="margin-left:100px;">Register</button>
            </div>
        </div>
        <div class="form-group" style="text-align:center;">
            <label>Do you already have an account?</label>           
            <a href="{{action('UserController@create')}}" style="margin-left:10px;">Sign in </a>           
        </div>
        </form>
    </div>
@endsection