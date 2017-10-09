@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Add Product</h2>
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
  <form action="{{action('ProductController@store')}}" method="post">
  {{csrf_field()}}
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" name="price">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea name="description" id="description"></textarea>
    </div>
    <div class="form-group">
      <label for="category_id">Category_id:</label>
      <select class="selectpicker show-tick" style="margin-left:20px; width: 150px;" name="category_id">
          <option value="">Please select...</option>
        @foreach($categories as $category)
          <option value="{{$category['id']}}">{{$category['name'] .'-'. $category['trademark']}}</option>
        @endforeach  
      </select>
    </div>
    <button type="submit" class="btn btn-success">Add</button>
  </form>
</div>
@endsection