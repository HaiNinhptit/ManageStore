@extends('layouts.admin')
@section('content')
<div class="container">
  <a href="{{action('UserController@create')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">New User</a>
  <h2>List User</h2>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Email</th>
        <th style="text-align:center;" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>
          <a href="{{action('UserController@adminEdit',['id' => $user->id])}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">Edit</a>
          </td>
          <td>
            <form action="{{action('UserController@destroy',['id' => $user->id])}}" method="post" id="form_dl">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="button" onclick="myFunction()" id="button_send">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach  
    </tbody>
  </table>
</div>
@endsection