@extends('layouts.home')
@section('content')  
    <div class="main">
      <div class="container">
        <!-- <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Cool green dress with red bell</li>
        </ul> -->
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          
          <!-- END SIDEBAR -->
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
                    <a href="{{action('ProductController@searchByCategory',['category_id'=> $category['id']])}}"><i class="fa fa-angle-right"></i> {{$category['name']}} </a>
                  </li>
                  @endforeach
                </ul>
              </li>
            @endforeach
           

           
             
            </ul>
          </div>
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="product-main-image">
                    <img src="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="{{URL::asset('/images/products/'. $product->pictures->first()['name'])}}">
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1>{{$product->name}}</h1>
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
                  <form action="{{action('CartController@create',['id_product' => $product->id])}}" method="post" id="form_dl">
                  {{csrf_field()}}
                  <div class="product-page-cart">
                    <div class="product-quantity">
                        <input id="product-quantity" name="product-quantity" type="text" value="1" readonly class="form-control input-sm">
                    </div>
                          <button class="btn btn-primary" type="submit">Add Cart</button>
                  </div>
                  </form>
                  <!-- </form> -->
                  <div class="review">
                    <!-- <input type="range" value="4" step="0.25" id="backing4"> -->
                    <div class="rateit" data-rateit-backingfld="#backing4" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                    </div>
                    @if (Session::has('user_id'))                    
                       <a href="javascript:;">{{$product->countComment()}} reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#review">Write a review</a>
                    @else
                      {{Session::put('review','1')}}
                      {{Session::put('id',$product->id)}}
                       <a href="javascript:;">{{$product->countComment()}} reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href={{action('UserController@login')}}>Write a review</a>
                    @endif   
                  </div>
                  <ul class="social-icons">
                    <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
                    <li><a class="evernote" data-original-title="evernote" href="javascript:;"></a></li>
                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a></li>
                  </ul>
                </div>

                <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li><a href="#Description" data-toggle="tab">Description</a></li>
                    <!-- <li><a href="#Information" data-toggle="tab">Information</a></li> -->                    
                       <li class="active"><a href="#Reviews" data-toggle="tab">Reviews (2)</a></li>  
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="Description">
                      <p>{{$product->description}}</p>
                    </div>

                    <div class="tab-pane fade in active" id="Reviews">
                      <!--<p>There are no reviews for this product.</p>-->
                      @foreach ($comments as $comment)
                      <div class="review-item clearfix">
                        <div class="review-item-submitted">
                          <strong>{{$comment->user->name}}</strong>
                          <em>{{$comment->getTime()}}</em>
                          <div class="rateit" data-rateit-value="5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                        </div>                                              
                        <div class="review-item-content">
                            <p>{{$comment->content}}</p>
                        </div>
                      </div>
                      @endforeach
                      <!-- BEGIN FORM-->
                      @if (Session::has('user_id'))
                      <form action="{{action('CommentController@create',['id' => $product->id])}}" class="reviews-form" role="form" method="post" id="review">
                      {{ csrf_field() }}
                      <h2>Write a review</h2>
                        <div class="form-group">
                          <label for="content">Review <span class="require">*</span></label>
                          <textarea class="form-control" rows="8" id="content" name="content"></textarea>
                        </div>
                        <div class="padding-top-20">                  
                          <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                      </form>
                      <!-- END FORM--> 
                      @endif
                    </div>
                  </div>
                </div>

                <!-- <div class="sticker sticker-sale"></div> -->
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

   
      </div>
    </div>
@endsection


