@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>List Products</h2>   
  <a href="{{action('ProductController@create')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">New Product</a>       
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Price</th>
        <th style="text-align:center;">Description</th>
        <th style="text-align:center;">Category ID</th>
        <th colspan="2" style="text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{$product['name']}}</td>
        <td>{{$product['price']}}</td>
        <td>{{$product['description']}}</td>
        <td>{{$product['category_id']}}</td>
        <td style="text-align:center;"><a href="{{action('ProductController@edit',['id' => $product['id']])}}" class="btn btn-warning">Edit</a></td>
        <td style="text-align:center;">
          <form action="{{action('ProductController@destroy',['id' => $product['id']])}}" method="post" id="form_dl">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <input id="id" value={{$product['id']}} type="hidden">
              <button class="btn btn-danger btn-delete" type="button"  id="{{$product['id']}}">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection