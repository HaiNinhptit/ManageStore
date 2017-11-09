@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>Detail Warehousing</h2>   
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Product ID</th>
        <th style="text-align:center;">Quantity</th>
        <th style="text-align:center;">Price</th>
        <th colspan="2" style="text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listProductWarehousings as $productWarehousing)
      <tr>
        <td>{{$productWarehousing['product_id']}}</td>
        <td>{{$productWarehousing['quantity']}}</td>
        <td>{{$productWarehousing['price']}}</td>
        <td style="text-align:center;"><a href="{{action('WarehousingController@getFormEdit', ['id' => $productWarehousing['id']])}}" class="btn btn-warning">Edit</a></td>
        <td style="text-align:center;">
          <form action="{{action('WarehousingController@delete', ['id' => $productWarehousing['id']])}}" method="post" id="form_dl">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <input id="id" value={{$productWarehousing['id']}} type="hidden">
              <button class="btn btn-danger btn-delete" type="button"  id="{{$productWarehousing['id']}}">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection