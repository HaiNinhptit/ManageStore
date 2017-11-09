@extends('layouts.admin')
@section('content')
<div class="container">
  <h2>List Warehousing</h2>   
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align:center;">Date Warehousing</th>
        <th colspan="1" style="text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($listDateWarehousings as $date)
      <tr>
        <td>{{$date['date']}}</td>
        <td style="text-align:center;"><a href="{{action('WarehousingController@detailWarehousing', ['date' => $date['date']])}}" class="btn btn-warning">Detail</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection