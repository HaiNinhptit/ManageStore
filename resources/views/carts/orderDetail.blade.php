@extends('layouts.master')
@section('content')
<div class="container">
  <h2>Show Order Detail</h2>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Product_id</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($order->orderProducts as $orderProduct)    
        <tr>
            <td>{{$orderProduct['product_id']}}</td>
            <td>{{$orderProduct['quantity']}}</td>
            <td>{{$orderProduct['price']}}</td>
        </tr> 
    @endforeach 
    </tbody>
  </table>
  Total:{{$order->totalPrice()}}
</div>
@endsection