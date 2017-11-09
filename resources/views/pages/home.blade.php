@extends('layouts.home')
@section('content')
    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-35">
        <div id="carousel-example-generic" class="carousel slide carousel-slider">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- First slide -->
                <div class="item carousel-item-four active">
                    <div class="container">
                        <div class="carousel-position-four text-center">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" data-animation="animated fadeInDown">
                                Tones of <br/><span class="color-red-v2">Shop UI Features</span><br/> designed
                            </h2>
                            <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">Lorem ipsum dolor sit amet constectetuer diam <br/>
                            adipiscing elit euismod ut laoreet dolore.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Second slide -->
                <div class="item carousel-item-five">
                    <div class="container">
                        <div class="carousel-position-four text-center">
                            <h2 class="animate-delay carousel-title-v4" data-animation="animated fadeInDown">
                                Unlimted
                            </h2>
                            <p class="carousel-subtitle-v2" data-animation="animated fadeInDown">
                                Layout Options
                            </p>
                            <p class="carousel-subtitle-v3 margin-bottom-30" data-animation="animated fadeInUp">
                                Fully Responsive
                            </p>
                            <a class="carousel-btn" href="#" data-animation="animated fadeInUp">See More Details</a>
                        </div>
                        <img class="carousel-position-five animate-delay hidden-sm hidden-xs" src="{{asset('assets/pages/img/shop-slider/slide2/price.png')}}" alt="Price" data-animation="animated zoomIn">
                    </div>
                </div>

                <!-- Third slide -->
                <div class="item carousel-item-six">
                    <div class="container">
                        <div class="carousel-position-four text-center">
                            <span class="carousel-subtitle-v3 margin-bottom-15" data-animation="animated fadeInDown">
                                Full Admin &amp; Frontend
                            </span>
                            <p class="carousel-subtitle-v4" data-animation="animated fadeInDown">
                                eCommerce UI
                            </p>
                            <p class="carousel-subtitle-v3" data-animation="animated fadeInDown">
                                Is Ready For Your Project
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Fourth slide -->
                <div class="item carousel-item-seven">
                   <div class="center-block">
                        <div class="center-block-wrap">
                            <div class="center-block-body">
                                <h2 class="carousel-title-v1 margin-bottom-20" data-animation="animated fadeInDown">
                                    The most <br/>
                                    wanted bijouterie
                                </h2>
                                <a class="carousel-btn" href="#" data-animation="animated fadeInUp">But It Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-4">
            <ul class="list-group margin-bottom-25 sidebar-menu">

            @foreach ($categoryByTrademarks as $categoryByTrademark)
              <li class="list-group-item clearfix dropdown">
                <a href="shop-product-list.html">
                  <i class="fa fa-angle-right"></i>
                  @foreach ($categoryByTrademark as $category)
                  {{$category['trademark']}}
                  @break;
                  @endforeach
                  
                </a>
                <ul class="dropdown-menu"> 
                  @foreach ($categoryByTrademark as $category)
                  <li class="list-group-item dropdown clearfix">
                  <a href="{{action('ProductController@searchByCategory',['category_id'=> $category['id']])}}">{{$category['name']}}</a>
                  </li>
                  @endforeach
                </ul>
              </li>
            @endforeach
           
            </ul>
          </div>
          <!-- END SIDEBAR -->
          <!-- woman -->
          <div class="col-md-9 col-sm-8">
            <h2>woman</h2>
            <div class="owl-carousel owl-carousel3">
            @foreach ($productWoman as $product)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="img-responsive" alt="{{$product->pictures->first()['name']}}" style="width:250px; height:200px;">
                    <div>
                      <a href="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="{{'#product-pop-up1' . $product->id}}" class="btn btn-default fancybox-fast-view">View</a>        
                    </div>
                  </div>
                  <h3><a href="shop-item.html">{{$product->name}}</a></h3>
                  <div class="pi-price">${{$product->price}}</div>
                  <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                    {{csrf_field()}}
                    <button class="btn btn-default add2cart" type="submit">Add Cart</button>
                  </form>
                  
                </div> 
                <div id="{{'product-pop-up1' .$product->id}}" style="display: none; width: 700px;">
                <div class="product-page product-pop-up">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-3">
                      <div class="product-main-image">
                        <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" alt="{{$product->pictures->first()['name']}}" class="img-responsive">
                      </div>
                      
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-9">
                      <h2>{{$product->name}}</h2>
                      <div class="price-availability-block clearfix">
                        <div class="price">
                          <strong><span>$</span>{{$product->price}}</strong>
                          <!-- <em>$<span>62.00</span></em> -->
                        </div>
                        <div class="availability">
                          @if($product->checkActive())
                             Availability: <strong>In Stock</strong>
                          @else
                             Availability: <strong>Not Available</strong>
                          @endif
                        </div>
                      </div>
                      <div class="description">
                        <p>{{$product->description}}</p>
                      </div>
                      <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                      {{csrf_field()}}
                      <div class="product-page-cart">
                        <div class="product-quantity">
                            <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
                        </div>
                        
                          
                          <button class="btn btn-primary" type="submit">Add Cart</button>
                    
                        <a href="{{action('ProductController@show',['id' => $product->id])}}" class="btn btn-default" style="margin-top:10px;">More details</a>
                      </div>
                      </form>
                    </div>

                    <div class="sticker sticker-new"></div>
                  </div>
                </div>
              </div>                
              </div>
              @endforeach
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
          <!-- end_woman -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-8 col-md-offset-3 col-md-offset-4">
            <h2>Man</h2>
            <div class="owl-carousel owl-carousel3">
            @foreach ($productMan as $product)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="img-responsive" alt="{{$product->pictures->first()['name']}}" style="width:250px; height:200px;">
                    <div>
                      <a href="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="{{'#product-pop-up1' . $product->id}}" class="btn btn-default fancybox-fast-view">View</a>        
                    </div>
                  </div>
                  <h3><a href="shop-item.html">{{$product->name}}</a></h3>
                  <div class="pi-price">${{$product->price}}</div>
                  <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                    {{csrf_field()}}
                    <button class="btn btn-default add2cart" type="submit">Add Cart</button>
                  </form>
                  
                </div> 
                <div id="{{'product-pop-up1' .$product->id}}" style="display: none; width: 700px;">
                <div class="product-page product-pop-up">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-3">
                      <div class="product-main-image">
                        <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" alt="{{$product->pictures->first()['name']}}" class="img-responsive">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-9">
                      <h2>{{$product->name}}</h2>
                      <div class="price-availability-block clearfix">
                        <div class="price">
                          <strong><span>$</span>{{$product->price}}</strong>
                          <!-- <em>$<span>62.00</span></em> -->
                        </div>
                        <div class="availability">
                          @if($product->checkActive())
                             Availability: <strong>In Stock</strong>
                          @else
                             Availability: <strong>Not Available</strong>
                          @endif
                        </div>
                      </div>
                      <div class="description">
                        <p>{{$product->description}}</p>
                      </div>
                      <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                      {{csrf_field()}}
                      <div class="product-page-cart">
                        <div class="product-quantity">
                            <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
                        </div>
                          <button class="btn btn-primary" type="submit">Add Cart</button>
                        
                        <a href="{{action('ProductController@show',['id' => $product->id])}}" class="btn btn-default" style="margin-top:10px;">More details</a>
                      </div>
                      </form>
                    </div>

                    <div class="sticker sticker-new"></div>
                  </div>
                </div>
              </div>                
              </div>
              @endforeach
            </div>
          </div>
          <!-- END CONTENT -->
          <div class="col-md-9 col-sm-8 col-md-offset-3 col-md-offset-4">
            <h2>Kid</h2>
            <div class="owl-carousel owl-carousel3">
            @foreach ($productKid as $product)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="img-responsive" alt="{{$product->pictures->first()['name']}}" style="width:250px; height:200px;">
                    <div>
                      <a href="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="{{'#product-pop-up1' . $product->id}}" class="btn btn-default fancybox-fast-view">View</a>        
                    </div>
                  </div>
                  <h3><a href="shop-item.html">{{$product->name}}</a></h3>
                  <div class="pi-price">${{$product->price}}</div>
                  <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                    {{csrf_field()}}
                    <button class="btn btn-default add2cart" type="submit">Add Cart</button>
                  </form>  
                </div> 
                <div id="{{'product-pop-up1' .$product->id}}" style="display: none; width: 700px;">
                <div class="product-page product-pop-up">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-3">
                      <div class="product-main-image">
                        <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" alt="{{$product->pictures->first()['name']}}" class="img-responsive">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-9">
                      <h2>{{$product->name}}</h2>
                      <div class="price-availability-block clearfix">
                        <div class="price">
                          <strong><span>$</span>{{$product->price}}</strong>
                          <!-- <em>$<span>62.00</span></em> -->
                        </div>
                        <div class="availability">
                          @if($product->checkActive())
                             Availability: <strong>In Stock</strong>
                          @else
                             Availability: <strong>Not Available</strong>
                          @endif
                        </div>
                      </div>
                      <div class="description">
                        <p>{{$product->description}}</p>
                      </div>
                      <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                      {{csrf_field()}}
                      <div class="product-page-cart">
                        <div class="product-quantity">
                            <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
                        </div>                      
                          <button class="btn btn-primary" type="submit">Add Cart</button>
                        
                        <a href="{{action('ProductController@show',['id' => $product->id])}}" class="btn btn-default" style="margin-top:10px;">More details</a>
                      </div>
                      </form>
                    </div>

                    <div class="sticker sticker-new"></div>
                  </div>
                </div>
              </div>                
              </div>
              @endforeach
            </div>
          </div>
        </div>
       
        </div>        
        <!-- END TWO PRODUCTS & PROMO -->
      </div>
    </div>
   <!-- phan chung -->
   @endsection