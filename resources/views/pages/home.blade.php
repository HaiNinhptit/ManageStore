@extends('layouts.master')
@section('content')

  <!-- <div class="my_swiper">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="images/products/image1.jpg" alt="anh1" style="width:1024px;heght:768px;"></div>
        <div class="swiper-slide"><img src="images/products/image2.jpg" alt="anh1" style="width:1024px;heght:768px;"></div>
        <div class="swiper-slide"><img src="images/products/image3.jpg" alt="anh1" style="width:1024px;heght:768px;"></div>
      </div>
    </div>
  </div>

<script>
  var swiper = new Swiper('.swiper-container', {
      pagination: '.swiper-pagination',
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      paginationClickable: true,
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: 2500,
      autoplayDisableOnInteraction: false
  });
</script>  -->
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

