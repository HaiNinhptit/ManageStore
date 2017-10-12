@extends('layouts.master')
@section('content')
<div class="container">
  <h2>Cart</h2>
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
     <h1>Ban chua co san pham trong gio hang</h1>
  @elseif (count($cart->cartProducts) > 0 )  
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align:center;">ID Product</th>
          <th style="text-align:center;">Quantity</th>
          <th style="text-align:center;">Price</th>
          <th colspan="2" style="text-align:center;">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart->cartProducts as $cart_product)
          <tr>
            <td>{{$cart_product['product_id']}}</td>
            <form action="{{action('CartController@update',['id'=>$cart_product['id']])}}" method="post" id="form_dl">
              <td class="quantity-td" style="width:50px;">
                <input class="form-control quantity-input" type="number" data-default="{{$cart_product['quantity']}}" min="1" maxlength="2" name="quantity"  id="quantity" value="{{$cart_product['quantity']}}">
              </td>
              <td>{{$cart_product->product->price}}</td>
              <td style="text-align:center;">
                {{csrf_field()}}
                <button class="btn btn-success" type="submit">Update</button>
              </td>
            </form>
            <form action="{{action('CartController@destroy',['id'=>$cart_product['id']])}}" method="post" id="form_dl">
              <td style="text-align:center;">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-success" type="button" onclick="myFunction()"  id="button_send">Delete</button>
              </td>
            </form>
          </tr> 
        @endforeach  
      </tbody>
    </table>
    <a href="{{action('CartController@showCart')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">Show Cart</a>   
  @else (\Session::has('products'))            
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="text-align:center;">ID Product</th>
          <th style="text-align:center;">Quantity</th>
          <th style="text-align:center;">Price</th>
          <th colspan="2" style="text-align:center;">Action</th>
        </tr>
      </thead>
    <tbody>
      @for ($i = 0 ; $i < count($arrays); $i++)
        <tr>
          <td>{{$arrays[$i]['id']}}</td>
          <form action="{{action('GuestController@update',['id' => $arrays[$i]['id']])}}" method="post" id="form_dl">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
            <td class="quantity-td" style="width:50px;">
              <input class="form-control quantity-input" type="number" data-default="{{$arrays[$i]['number']}}" min="1" maxlength="2" name="quantity"  id="quantity" value="{{$arrays[$i]['number']}}">
            </td>
            <td>{{$arrays[$i]['price']}}</td>
            <td style="text-align:center;">
              <button class="btn btn-success" type="submit">Update</button>
            </td>
          </form>
          <form action="{{action('GuestController@destroy',['id' => $arrays[$i]['id']])}}" method="post" id="form_dl">
            <td style="text-align:center;">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-success" type="submit">Delete</button>
            </td>
          </form>
        </tr> 
      @endfor  
    </tbody>
    </table>
    <a href="{{action('GuestController@showCart')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">Show Cart</a>
  @endif
</div>
@endsection