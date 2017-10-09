@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Add Category</h2>
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
  <form action="{{action('CategoryController@store')}}" method="post">
  {{csrf_field()}}
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label for="trademark">Trademark:</label>
      <input type="text" class="form-control" name="trademark">
    </div>
    <button type="submit" class="btn btn-success">Add</button>
  </form>
</div>
@endsection