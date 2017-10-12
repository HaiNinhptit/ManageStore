@extends('layouts.admin')
@section('content')
<div class="content" style="border: 1px solid grey;border-radius: 25px; width:900px; margin-left:100px; padding-left:50px;">
<h2 style="color:red; margin-bottom:30px; margin-left:150px;">EDIT USER</h2>
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
<form class="form-horizontal" method="post" action="{{action('UserController@adminUpdate',['id' => $user->id])}}">
{{csrf_field()}}
<input name="_method" type="hidden" value="PATCH">
<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Name</label>
  <div class="col-sm-8">
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{$user->name}}">
  </div>
</div>
<div class="form-group">
  <label for="email" class="col-sm-2 control-label">Email</label>
  <div class="col-sm-8">
    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}" readOnly="">
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-danger" style="margin-left:100px;">CHANGE</button>
  </div>
</div>
</form>
</div>
@endsection
