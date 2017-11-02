@extends('layouts.home')
@section('content')
<div class="container">
  <h2>Đổi mật khẩu</h2>
  <p>Vui lòng nhập mật khẩu mới của bạn tại đây</p>
  <form action="{{action('UserController@postNewPassword',['email'=>$email, 'token'=>$token])}}" method="post">
  {{csrf_field()}}
    <div class="form-group">
      <label for="email">Mật khẩu:</label>
      <input type="password" class="form-control" placeholder="Enter email" name="password">
    </div>
    <div class="form-group">
      <label for="email">Nhập lại mật khẩu:</label>
      <input type="password" class="form-control" placeholder="Enter email" name="confirmPassword">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
  </form>
</div>
@endsection