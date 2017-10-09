@extends('layouts.master')
@section('content')
<div class="container">
  <h2>Confirm cart</h2> 
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
  @if ($cart == NULL) 
   <h1>Ban khong co san pham nao trogn gio hang</h1>
  @else     
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID Product</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
    @foreach($cart->cartProducts as $cart_product)
      <tr>
        <td>{{$cart_product['product_id']}}</td>
        <td>{{$cart_product['quantity']}}</td>
        <td>{{$cart_product->product->price}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:20px;"><span>Total: </span>{{$cart->totalPrice()}}</div>
  <a href="{{action('CartController@order')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">Order</a>
  @endif
</div>
@endsection