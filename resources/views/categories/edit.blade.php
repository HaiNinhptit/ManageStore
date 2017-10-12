@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Edit Category</h2>
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
  <form action="{{action('CategoryController@update',['id'=>$category->id])}}" method="post">
  {{csrf_field()}}
  <input name="_method" type="hidden" value="PATCH">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" value="{{$category->name}}">
    </div>
    <div class="form-group">
      <label for="trademark">Trademark:</label>
      <input type="text" class="form-control" name="trademark" value="{{$category->trademark}}">
    </div>
    <button type="submit" class="btn btn-success">Change</button>
  </form>
</div>
@endsection