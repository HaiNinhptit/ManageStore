@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Edit Warehousing</h2>
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
  <form action="{{action('WarehousingController@update', ['id' => $warehousingDetail['id']])}}" method="post">
  {{csrf_field()}}
  <input name="_method" type="hidden" value="PATCH">
    <div class="form-group">
      <label for="product_id">Product ID:</label>
      <select class="selectpicker show-tick" style="margin-left:20px; width: 150px;" name="product_id">
        @foreach($products as $product)
          @if ($warehousingDetail-> product_id == $product['id'] )
          <option value="{{$product['id']}}" selected="selected">{{$product['name']}}</option>
          @else
          <option value="{{$product['id']}}">{{$product['name']}}</option>
          @endif
        @endforeach  
      </select>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input type="number" class="form-control" name="quantity" value="{{$warehousingDetail->quantity}}">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" name="price" value="{{$warehousingDetail->price}}">
    </div>
    <button type="submit" class="btn btn-success">Change</button>
  </form>
</div>
@endsection