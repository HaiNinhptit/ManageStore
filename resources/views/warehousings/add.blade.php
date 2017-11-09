@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Add product of warehousing </h2>
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
  <form action="{{action('WarehousingController@store')}}" method="post">
  {{csrf_field()}}
    <div class="form-group">
      <label for="product_id">ID product</label>
      <select class="selectpicker show-tick" style="margin-left:20px; width: 150px;" name="product_id">
          <option value="">Please select...</option>
        @foreach($products as $product)
          <option value="{{$product['id']}}">{{$product['name']}}</option>
        @endforeach  
      </select>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity:</label>
      <input type="number" class="form-control" name="quantity">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" name="price">
    </div>
    <div class="form-group">
      <label for="date">Date:</label>
      <input type="text" class="form-control" name="date" placeholder="yyyy-mm-dd">
    </div>
    <button type="submit" class="btn btn-success">Add</button>
  </form>
</div>
@endsection