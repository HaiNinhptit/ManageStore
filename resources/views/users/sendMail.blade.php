@extends('layouts.home')
@section('content')
<div class="container">
  <h2>Bạn quên mật khẩu ?</h2>
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
  <p>Nhập địa chỉ email của bạn dưới đây và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu của bạn.</p>
  <form action="{{action('UserController@postFormSendMail')}}" method="post">
  {{csrf_field()}}
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" placeholder="Enter email" name="email">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
  </form>
</div>
@endsection