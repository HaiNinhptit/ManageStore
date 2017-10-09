@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Add Picture</h2>
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
    <form method="post" action="{{action('PictureController@store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group">
            <label for="product_id">Product_id</label>
            <select class="selectpicker show-tick" style="margin-left:20px; width: 150px;" name="product_id">
                <option value="">Please select...</option>
                @foreach($products as $product)
                <option value="{{$product['id']}}">{{$product['name']}}</option>
                @endforeach  
            </select>
        </div>
        <div class="form-group">
            <label for="name">Choose file</label>
            <input type="file" id="name_file" name="name">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>
@endsection