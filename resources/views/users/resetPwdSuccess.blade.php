@extends('layouts.home')
@section('content')
<div class="container">
<h1>Mật khẩu của bạn đã được đổi thành công</h1>
<a href="{{action('UserController@index')}}" class="btn btn-primary">Tiếp tục mua hàng</a>
</div>
@endsection