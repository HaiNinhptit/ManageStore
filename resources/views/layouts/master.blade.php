<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <script src="{{asset('jquery/jquery.min.js')}}"></script>
  <script src="{{asset('js/myjs.js')}}"></script> 
  <script src="{{asset('js/myjs2.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script> 
  <script src="{{asset('js/swiper.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
  <link rel="stylesheet" href="{{asset('css/mystyle2.css')}}">
</head>
<body>

<nav class="navbar navbar-inverse" style="background-color:blue;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="{{action('UserController@index')}}">Home</a></li>
      @if ( \Session::has('user_id'))
        <li></li>
        <li><a href="{{action('UserController@logout')}}">Log out</a></li> 
        <li>
          <div class="dropdown" style="margin-top:10px; border:none;">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Wellcome {{Session::get('name')}}
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="{{action('UserController@edit')}}">Edit User</a></li>
            </ul>
          </div>
        </li>
        <li><a href="{{action('CartController@index')}}">Cart</a></li>
        <li><a href="{{action('CartController@showOrder')}}">Order</a></li>
      @else
        <li><a href="{{action('UserController@create')}}">Register</a></li>
        <li><a href="{{action('UserController@login')}}">Sign in</a></li>
      @endif
    </ul>
    <form class="navbar-form navbar-left" action="{{action('ProductController@search')}}" method="post">
    {{csrf_field()}}  
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search" id="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</nav> 
<div class="container">
    @yield('content')
</div>
</body>
</html>







