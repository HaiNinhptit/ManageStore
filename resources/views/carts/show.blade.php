@extends('layouts.master')
@section('content')
<div class="container">
  <h2>Show Order</h2>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Order_id</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($user->orders as $order)
        <tr>
            <td>{{$order['id']}}</td>
            <td><a href="{{action('CartController@showOrderDetail',['id' => $order['id']])}}" class="btn btn-success" role="button" style="margin-bottom:10px;">Detail</a></td>
        </tr> 
    @endforeach 
    </tbody>
  </table>
  Total:{{$user->total()}}
</div>
@endsection