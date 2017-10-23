
<!-- //home -->
@extends('layouts.master')
@section('content')
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
@foreach($products as $product)
  <div class="col-sm-6 col-md-4" style="text-align:center;">
    <div class="thumbnail">  
      <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" alt=""/>
      <div class="caption">
        <h3 style="color: red; text-transform: uppercase;">{{$product['name']}}</h3>
        <span style="color:red;">{{$product['price']}} VND</span>
        <p>
          <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                {{csrf_field()}}
                <button class="btn btn-danger" type="submit">Add Cart</button>
          </form>
        </p>  
        <a href="{{action('ProductController@show',['id' => $product['id']])}}" class="btn btn-primary" role="button">Show Detail</a></p>
      </div>
    </div>
  </div>
@endforeach
@endsection

<!-- 
endhome -->


//product detail

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



//carts.index  

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



//carts.order  

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
  @elseif (count($cart->cartProducts) > 0)     
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
      @for ($i = 0 ; $i < count($arrays); $i++)
        <tr>
          <td>{{$arrays[$i]['id']}}</td>
          <td>{{$arrays[$i]['number']}}</td>
          <td>{{$arrays[$i]['price']}}</td>
        </tr>
      @endfor
      </tbody>
    </table>
    <div style="margin-top:20px;"><span>Total: </span>{{$tong}}</div>
    <a href="{{action('GuestController@checkOrder')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">Order</a> 
  @endif
</div>
@endsection