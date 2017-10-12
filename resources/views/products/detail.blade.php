@extends('layouts.master')
@section('content')
<div class="content">
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
    <ul class="media-list">
    <li class="media">
        <div class="media-left">
        <a href="#">
            <img class="media-object"  src="{{URL::asset('/images/products/'. $product->pictures->first()->name)}}" alt="" style="height:500px;with:500px;">
        </a>
        </div>
        <div class="media-body">
        <h4 class="media-heading" style="color:red; text-transform: uppercase;">{{$product->name}}</h4>
        <p style="color:red;">{{$product->price}} VND</p>
        <p>{{$product->description}}</p>
        <p>
            <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                    {{csrf_field()}}
                    <button class="btn btn-danger" type="submit">Add Cart</button>
            </form>
        </p>
        </div>
    </li>
    </ul>
    @if(\Session::has('user_id'))
    <form action="{{action('CommentController@create',['id' => $product->id])}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
        <label for="content">Bạn hãy nhận xét về sản phẩm này: </label>
        <textarea class="form-control" name="content" id="content" rows="3" cols="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Comment</button>
    </form>
    @endif
    <h2 style="margin-top:100px; color:red;" >Comment</h2>
    <ul class="media-list">
        @for($i = count($comments) - 1; $i >=0; $i--)
        <li class="media">
        <div class="media-body">
        <p class="media-heading" id="show1">{{$comments[$i]->content}}</p>
        @if ($comments[$i]->user_id == Session::get('user_id'))
        <form action="{{action('CommentController@updateComment',['id' => $comments[$i]->id, 'id_product' => $product->id])}}" method="post" id="show2" class="hidden1" style="margin-bottom:10px;">
        {{ csrf_field() }}
        <div class="form-group">
        <textarea class="form-control" name="content1" id="content1" rows="1" cols="1">{{$comments[$i]->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Comment</button>
        </form>
        <form action="{{action('CommentController@destroy',['id' => $comments[$i]->id, 'id_product' => $product->id])}}" method="post" id="form_dl">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger" type="button" onclick="myFunction()" id="button_send" style="float:left;">Delete</button>
        </form>
        <button type="button" class="btn btn-warning" onclick="myFunction2()" style="margin-left:10px;">Edit</button>
        @endif
        <div><strong>{{$comments[$i]->user->name}}</strong><span style="margin-left:20px;">{{$comments[$i]->getTime()}}</span>
        </div>
        </div>
        </li> 
        @endfor  
    </ul>
    
</div>    
@endsection