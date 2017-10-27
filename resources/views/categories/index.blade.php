@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>List Categories</h2>   
  <a href="{{action('CategoryController@create')}}" class="btn btn-primary" role="button" style="margin-bottom:10px;">New Category</a>       
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Producer</th>
        <th colspan="2" style="text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <td>{{$category['name']}}</td>
        <td>{{$category['trademark']}}</td>
        <td style="text-align:center;"><a href="{{action('CategoryController@edit',['id'=>$category['id']])}}" class="btn btn-warning">Edit</a></td>
        <td style="text-align:center;">
          <form action="{{action('CategoryController@destroy',['id'=>$category['id']])}}" method="post" id="form_dl">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger btn-delete" type="button" id="{{$category['id']}}">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection