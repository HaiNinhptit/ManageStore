@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>List Picture</h2>   
  <a href="{{action('PictureController@create')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">New Picture</a>       
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Product ID</th>
        <th colspan="2" style="text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pictures as $picture)
      <tr>
        <td>{{$picture['name']}}</td>
        <td>{{$picture['product_id']}}</td>
        <td style="text-align:center;"><a href="{{action('PictureController@edit',['id' => $picture['id']])}}" class="btn btn-warning">Edit</a></td>
        <td style="text-align:center;">
          <form action="{{action('PictureController@destroy',['id' => $picture['id']])}}" method="post" id="form_delete">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <input id="id" value={{$picture['id']}} type="hidden">
              <button class="btn btn-danger btn-delete" type="button"  id="{{$picture['id']}}">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection