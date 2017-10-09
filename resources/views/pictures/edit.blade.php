@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Edit Image</h2>
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
  <form action="{{action('PictureController@update',['id'=> $picture->id])}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <input name="_method" type="hidden" value="PATCH">
    <div class="form-group">
        <label for="name">Choose file</label>
        <input type="file" id="name_file" name="name">
    </div>
    <div class="form-group">
        <label for="name_file">Name File</label>
        <input type="text"  name="name_file" value="{{$picture->name}}">
    </div>
    <div class="form-group">
      <label for="product_id">Product_id:</label>
      <select class="selectpicker show-tick" style="margin-left:20px; width: 150px;" name="product_id" disabled>
        @foreach($products as $product)
          @if ($picture-> id == $product['id'] )
          <option value="{{$product['id']}}" selected="selected">{{$product['name']}}</option>
          @else
          <option value="{{$product['id']}}">{{$product['name']}}</option>
          @endif
        @endforeach  
      </select>
    </div>
    <button type="submit" class="btn btn-success">Change</button>
  </form>
</div>
@endsection