@extends('layouts.home')
@section('content') 
    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Description</th>
                    <th class="goods-page-quantity">Quantity</th>
                    <th class="goods-page-quantity">Action</th>
                    <th class="goods-page-price">Unit price</th>
                    <th class="goods-page-total" colspan="2">Total</th>
                  </tr>
                  @if (isset($cart))
                    @foreach($cart->cartProducts as $cart_product)
                    <tr>
                        <td class="goods-page-image">
                          <a href="javascript:;"><img src="{{URL::asset('/images/products/'. $cart_product->product->pictures->first()['name'])}}" alt="Berry Lace Dress"></a>
                        </td>
                        <td class="goods-page-description">
                          <h3 style="color:red;">{{$cart_product->product->description}}</h3>
                          <!-- <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                          <em>More info is here</em> -->
                        </td>
                        <form action="{{action('CartController@update',['id'=>$cart_product['id']])}}" method="post" id="form_dl">
                          {{csrf_field()}}
                          <td class="goods-page-quantity">
                                <input id="quantity" name="quantity" type="number" value="{{$cart_product['quantity']}}"  class="product-quantity form-control input-sm" data-default="{{$cart_product['quantity']}}" min="1" maxlength="2">
                          </td>
                          <td class="goods-page-ref-no">
                            <button class="btn btn-success" type="submit">Update</button>
                          </td>
                        </form>
                        <td class="goods-page-price">
                          <strong><span>$</span>{{$cart_product->product->price}}</strong>
                        </td>
                        <td class="goods-page-total">
                          <strong><span>$</span>{{$cart_product->product->price * $cart_product->quantity}}</strong>
                        </td>

                        <form action="{{action('CartController@destroy',['id'=>$cart_product['id']])}}" method="post" id="form_dl">
                          <td style="text-align:center;">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-success btn-delete" type="button" id="{{$cart_product['id']}}">Delete</button>
                          </td>
                        </form>
                    </tr>
                    @endforeach
                  </table>
                  </div>

                  <div class="shopping-total">
                    <ul>
                      <li class="shopping-total-price">
                        <em>Total</em>
                        <strong class="price"><span>$</span>{{$cart->totalPrice()}}</strong>
                      </li>
                    </ul>
                  </div>
                @else
                  @for ($i = 0; $i < count($products); $i++ )
                    <tr>
                        <td class="goods-page-image">
                          <a href="javascript:;"><img src="{{URL::asset('/images/products/'. $productCart[$i]->pictures->first()['name'])}}" alt="$productCart[$i]->pictures->first()['name']"></a>
                        </td>
                        <td class="goods-page-description">
                          <h3 style="color:red;">{{$productCart[$i]->description}}</h3>
                          <!-- <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                          <em>More info is here</em> -->
                        </td>
                        <form action="{{action('GuestController@update',['id'=> $products[$i]['id']])}}" method="post" id="form_dl">
                          {{csrf_field()}}
                          <td class="goods-page-quantity">
                                <input id="quantity" name="quantity" type="number" value="{{$products[$i]['number']}}"  class="product-quantity form-control input-sm" data-default="{{$products[$i]['number']}}" min="1" maxlength="2">
                          </td>
                          <td class="goods-page-ref-no">
                            <button class="btn btn-success" type="submit">Update</button>
                          </td>
                        </form>
                        <td class="goods-page-price">
                          <strong><span>$</span>{{$products[$i]['price']}}</strong>
                        </td>
                        <td class="goods-page-total">
                          <strong><span>$</span>{{$products[$i]['price'] * $products[$i]['number']}}</strong>
                        </td>

                        <form action="{{action('GuestController@destroy',['id'=>$products[$i]['id']])}}" method="post" id="form_dl">
                          <td style="text-align:center;">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-success btn-delete" type="button" id="{{$products[$i]['id']}}">Delete</button>
                          </td>
                        </form>
                    </tr>
                    @endfor
                  </table>
                  </div>

                  <div class="shopping-total">
                    <ul>
                      <li class="shopping-total-price">
                        <em>Total</em>
                        <strong class="price"><span>$</span>{{$total}}</strong>
                      </li>
                    </ul>
                  </div>
                @endif
              </div>
              <a href="{{action('UserController@index')}}" class="btn btn-default">Continue shopping <i class="fa fa-shopping-cart"></i></a>
              <a href="{{action('GuestController@showCart')}}" class="btn btn-primary">Checkout <i class="fa fa-check"></i></a>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
@endsection
