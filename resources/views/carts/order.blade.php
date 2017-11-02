
@extends('layouts.home')
@section('content') 
<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Checkout</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Checkout</h1>
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">
              <div id="checkout" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page"  class="accordion-toggle">
                      Confirm Order
                    </a>
                  </h2>
                </div>
                <div id="confirm-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-12 clearfix">
                      <div class="table-wrapper-responsive">
                      <table>
                        @if(isset($cart))
                          @foreach($cart->cartProducts as $cart_product)
                            <tr>
                              <td class="checkout-image">
                                <a href="javascript:;"><img src="{{URL::asset('/images/products/'. $cart_product->product->pictures->first()['name'])}}" alt="{{$cart_product->product->pictures->first()['name']}}"></a>
                              </td>
                              <td class="checkout-description">
                                <h3><a href="javascript:;">{{$cart_product->product->description}}</a></h3>
                              </td>
                              <td class="checkout-quantity">{{$cart_product['quantity']}}</td>
                              <td class="checkout-price"><strong><span>$</span>{{$cart_product->product->price}}</strong></td>
                              <td class="checkout-total"><strong><span>$</span>{{$cart_product->product->price * $cart_product->quantity}}</strong></td>
                            </tr>
                          @endforeach
                        @elseif (isset($products))
                          @for ($i = 0; $i < count($products); $i++ )
                            <tr>
                                  <td class="checkout-image">
                                    <a href="javascript:;"><img src="{{URL::asset('/images/products/'. $productCart[$i]->pictures->first()['name'])}}" alt="{{$productCart[$i]->pictures->first()['name']}}"></a>
                                  </td>
                                  <td class="checkout-description">
                                    <h3><a href="javascript:;">{{$productCart[$i]->description}}</a></h3>
                                  </td>
                              <td class="checkout-quantity">{{$products[$i]['number']}}</td>
                              <td class="checkout-price"><strong><span>$</span>{{$products[$i]['price']}}</strong></td>
                              <td class="checkout-total"><strong><span>$</span>{{$products[$i]['price'] * $products[$i]['number']}}</strong></td>
                            </tr>
                          @endfor
                        @else
                        <h1>Ban khong co san pham trong gio hang!</h1>  
                        @endif
                      </table>
                      </div>
                      <div class="checkout-total-block">
                        <ul>   
                          <li class="checkout-total-price">
                            
                            @if(isset($cart))
                               <em>Total</em>
                               <strong class="price"><span>$</span>{{$cart->totalPrice()}}</strong>
                            @elseif (isset($products))
                               <em>Total</em>
                               <strong class="price"><span>$</span>{{$total}}</strong>
                            @else
                               <!-- <strong class="price"><span>$</span>0</strong> -->
                            @endif   
                          </li>
                        </ul>
                      </div>
                      @if (isset($cart) || isset($products))
                        <div class="clearfix"></div>
                        
                        <a href="{{action('GuestController@checkOrder')}}" class="btn btn-primary pull-right" type="submit" id="button-confirm" style="color:white;">Confirm Order</button> 
                        <a href="{{action('UserController@index')}}" type="button" class="btn btn-default pull-right margin-right-20">Cancel</a>
                        
                      @endif  

                    </div>
                  </div>
                </div>
              </div>
              <!-- END CONFIRM -->
            </div>
            <!-- END CHECKOUT PAGE -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
@endsection
