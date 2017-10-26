@extends('layouts.home')
@section('content')
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Search result</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <div class="sidebar-filter margin-bottom-25">
              <h2>Search categories</h2>
              <h3>Availability</h3>
              <div class="checkbox-list">
                <label><input type="checkbox"> Not Available (3)</label>
                <label><input type="checkbox"> In Stock (26)</label>
              </div>

              <h3>Price</h3>
              <p>
                <label for="amount">Range:</label>
                <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
              </p>
              <div id="slider-range"></div>
            </div>

            <div class="sidebar-products clearfix">
              <h2>Bestsellers</h2>
  
              <!-- <div class="item">
                <a href="shop-item.html"><img src="assets/pages/img/products/k3.jpg" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="shop-item.html">Some Shoes in Animal with Cut Out</a></h3>
                <div class="price">$86.00</div>
              </div> -->

            </div>
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
          <form action="{{action('ProductController@searchByCategory')}}" method="get" id="form_limit" name="form_limit">
          {{csrf_field()}}
            <div class="content-search margin-bottom-20">
              <div class="row">
                <div class="col-md-6">
                </div>
                @if(!Session::has('search'))
                  {{Session::forget('search_content')}}
                  <div class="col-md-6">
                    <div class="input-group">
                      <input type="text" placeholder="Search again" class="form-control" name="search1" id="search1" value={{Session::get('content1')}}>
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Search</button>
                      </span>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                <a href="javascript:;"><i class="fa fa-th-list"></i></a>
              </div>
              <div class="col-md-10 col-sm-10">
                <div class="pull-right">
                  <label class="control-label">Show:</label>
                    <select class="form-control input-sm" id="limit" name="limit" onchange="changeAction()">
                      <option value="3" @if(Session::get('limit') == 3) selected="selected" @endif >3</option>
                      <option value="6" @if(Session::get('limit') == 6) selected="selected" @endif >6</option>
                      <option value="9" @if(Session::get('limit') == 9) selected="selected" @endif >9</option>
                      <option value="12" @if(Session::get('limit') == 12) selected="selected" @endif >12</option>
                      <option value="15" @if(Session::get('limit') == 15) selected="selected" @endif >15</option>
                    </select>
      
                </div>
                <div class="pull-right">
                  <label class="control-label">Sort&nbsp;By:</label>
                  <select class="form-control input-sm" name="sortBy" id="sortBy" onchange="changeAction()">
                    <option value="0" @if(Session::get('sortBy') == 0) selected="selected" @endif>Default</option>
                    <option value="1" @if(Session::get('sortBy') == 1) selected="selected" @endif>Name (A - Z)</option>
                    <option value="2" @if(Session::get('sortBy') == 2) selected="selected" @endif>Name (Z - A)</option>
                    <option value="3" @if(Session::get('sortBy') == 3) selected="selected" @endif>Price (Low &gt; High)</option>
                    <option value="4" @if(Session::get('sortBy') == 4) selected="selected" @endif>Price (High &gt; Low)</option>
                  </select>
                </div>
              </div>
            </div>
            @if(Session::has('search'))
              {{Session::forget('search')}}
            @else 
              <input name="category_id" type="hidden" value={{$category_id}}>
            @endif
          </form>
            <!-- BEGIN PRODUCT LIST -->
            <!-- 3 hang row -->
            <div class="row product-list">
              <!-- PRODUCT ITEM START -->
              @foreach ($products as $product)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="img-responsive" alt="{{$product->pictures->first()['name']}}" style="width:200px; height:165px;">
                        <div>
                        <a href="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="{{'#product-pop-up3' . $product->id}}" class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                    </div>
                    <h3><a href="shop-item.html">{{$product->name}}</a></h3>
                    <div class="pi-price">${{$product->price}}</div>
                    <form action="{{action('CartController@create',['id_product' => $product['id']])}}" method="post" id="form_dl">
                      {{csrf_field()}}
                      <button class="btn btn-default add2cart" type="submit">Add Cart</button>
                    </form>
                    </div>
                    <div id="{{'product-pop-up3' .$product->id}}" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-3">
                            <div class="product-main-image">
                                <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" alt="{{$product->pictures->first()['name']}}" class="img-responsive">
                            </div>
                            <!-- <div class="product-other-images">
                                <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="{{asset('assets/pages/img/products/model3.jpg')}}"></a>
                                <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('assets/pages/img/products/model4.jpg')}}"></a>
                                <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('assets/pages/img/products/model5.jpg')}}"></a>
                            </div> -->
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                            <h2>{{$product->name}}</h2>
                            <div class="price-availability-block clearfix">
                                <div class="price">
                                <strong><span>$</span>{{$product->price}}</strong>
                                <!-- <em>$<span>62.00</span></em> -->
                                </div>
                                <div class="availability">
                                Availability: <strong>In Stock</strong>
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

                            <div class="sticker sticker-sale"></div>
                        </div>
                        </div>
                    </div>                
                </div>
              @endforeach  
             
            </div>      
          
            {{ $products->links() }}
            <!-- END PAGINATOR -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
@endsection
