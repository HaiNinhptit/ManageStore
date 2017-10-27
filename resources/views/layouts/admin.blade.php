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
</head>
<body>
<div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{action('UserController@index')}}">Home</a>
    </div>
    <ul class="nav navbar-nav">
        <li>
            <div class="dropdown" style="margin-top:10px;">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Category
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{action('CategoryController@index')}}">List Category</a></li>
                    <li><a href="{{action('CategoryController@create')}}">Add Category</a></li>     
                </ul>
            </div>
       </li>
       <li>
            <div class="dropdown" style="margin-top:10px; margin-left:20px;">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Product
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{action('ProductController@index')}}">List Product</a></li>
                    <li><a href="{{action('ProductController@create')}}">Add Product</a></li>     
                </ul>
            </div>
       </li>
       <li>
            <div class="dropdown" style="margin-top:10px; margin-left:20px;">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Picture
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{action('PictureController@index')}}">List picture</a></li>
                    <li><a href="{{action('PictureController@create')}}">Add picture</a></li>     
                </ul>
            </div>
       </li>
       <li>
            <div class="dropdown" style="margin-top:10px;margin-left:20px;">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">User
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{action('UserController@listUser')}}">List User</a></li>
                </ul>
            </div>
        </li>
        <li>
        <a href="{{action('UserController@adminLogout')}}">Logout</a>
        </li>
      
    </ul>
  </div>
</nav>
@yield('content')
</div>
</body>
</html>
