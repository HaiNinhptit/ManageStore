@extends('layouts.master')
@section('content')
<div class="content">
    <ul class="media-list">
    <li class="media">
        <div class="media-left">
        <a href="#">
            <img class="media-object"  src="{{URL::asset('/images/products/'. $product->pictures->first()->name)}}" alt="">
        </a>
        </div>
        <div class="media-body">
        <h4 class="media-heading" style="color:red; text-transform: uppercase;">{{$product->name}}</h4>
        <p style="color:red;">{{$product->price}} VND</p>
        <p>{{$product->description}}</p>
        <p><a href="#" class="btn btn-primary" role="button">Add Cart</a></p>
        </div>
    </li>
    </ul>
</div>    
@endsection