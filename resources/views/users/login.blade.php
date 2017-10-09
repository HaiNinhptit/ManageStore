@extends('layouts.master')
@section('content')
<div class="content" style="border: 1px solid grey;border-radius: 25px; width:600px; margin-left:300px;">
  <h2 style="color:red; margin-bottom:50px;margin-left: 200px;">LOGIN</h2>
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
  <form class="form-horizontal" method="post" action="{{action('UserController@postLogin')}}">
  {{csrf_field()}}
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-5">
      <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-5">
      <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary" style="margin-left:100px;">SIGN IN</button>
      </div>
    </div>
  </form>
</div>
@endsection