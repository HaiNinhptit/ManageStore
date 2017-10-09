@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Edit Product</h2>
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
  <form action="{{action('ProductController@update',['id' => $product->id])}}" method="post">
  {{csrf_field()}}
  <input name="_method" type="hidden" value="PATCH">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" value="{{$product->name}}">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" name="price" value="{{$product->price}}">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea name="description" id="description">{{$product->description}}</textarea>
    </div>
    <div class="form-group">
      <label for="category_id">Category_id:</label>
      <select class="selectpicker show-tick" style="margin-left:20px; width: 150px;" name="category_id">
        @foreach($categories as $category)
          @if ($product-> id == $category['id'] )
          <option value="{{$category['id']}}" selected="selected">{{$category['name'] .'-'. $category['trademark']}}</option>
          @else
          <option value="{{$category['id']}}">{{$category['name'] .'-'. $category['trademark']}}</option>
          @endif
        @endforeach  
      </select>
    </div>
    <button type="submit" class="btn btn-success">Change</button>
  </form>
</div>
@endsection