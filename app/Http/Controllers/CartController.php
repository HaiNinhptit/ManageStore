<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\CartProduct;
use App\Order;
use App\OrderProduct;
use App\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.check')->only('showOrder', 'showOrderDetail','order');
    }
    public function index(Request $request)
    {
        if($request->session()->has('user_id'))
        {
            $id = $request->session()->get('user_id');
            $cart = User::find($id)->cart;
            return view('carts.index',compact('cart'));
        }
        else
        {
            $cart = new Cart();
            $arrays = $request->session()->get('products');


            return view('carts.index',compact('cart', 'arrays'));
        }
        
    }
    //
    public function create(Request $request, $id_product)
    {
       if($request->session()->has('user_id')) 
       {
            $id = $request->session()->get('user_id');
            $cart = User::find($id)->cart;
            if($cart == NULL)
            {
                //create Cart
                $cart = new Cart();
                $cart->user_id = $id;
                $cart->save();
    
                //create CartProduct
                $cart_product = new CartProduct();
                $cart_product->cart_id =$cart->id;
                $cart_product->product_id = $id_product;
                $cart_product->quantity = 1;
                $cart_product->save();
                return redirect('carts')->with('success','A new product has been added to the cart');
            }
            else
            {
                $check = 1;//chua co san pham
        
                foreach ($cart->products as $product) {
                    //
                    if($product->id == $id_product)
                    {
                        $check = 0;
                        break;          
                    }  
                }
                
                if($check == 1)
                {
                    $cart_product = new CartProduct();
                    $cart_product->cart_id =$cart->id;
                    $cart_product->product_id = $id_product;
                    $cart_product->quantity = 1;
                    $cart_product->save(); 
                    return redirect('carts')->with('success','A new product has been added to the cart');
                }
                else
                {
                    $cart_products = $cart->cartProducts;
                    foreach($cart_products as $cart_product)
                    {
                        if($cart_product->product_id == $id_product)
                        {
                            $cart_product->quantity = $cart_product->quantity + 1;
                            $cart_product->save();
                            return redirect('carts')->with('success','A new product has been added to the cart');
        
                        }
                    }
                }
           
            }
        }
        else
        {
            $check = 1;
            $arrays = $request->session()->get('products');
            for($i = 0; $i < count($arrays); $i++)
            {
                if ($arrays[$i]['id'] == $id_product)
                {
                    $arrays[$i]['number'] = $arrays[$i]['number'] + 1;
                    $check = 0;
                    break;
                }
            }
            
            if($check == 1)
            {
                $price = Product::find($id_product)->price;
                $request->session()->push('products',['id'=>$id_product,'number'=>1, 'price' => $price]);
                return redirect('carts')->with('success','Add product access');
            }
            else
            {
                $request->session()->put('products',$arrays);

                return redirect('carts')->with('success','Add product access');
                
            }

           
        }
       
    }

    public function destroy($id)
    {
        //
        $cart_product = CartProduct::find($id);
        $cart_product->delete();
        return redirect('carts');
    }

    public function update(Request $request, $id)
    {
        $cart_product = CartProduct::find($id);
        $cart_product->quantity= $request->input('quantity');
        $cart_product->save();
        return redirect('carts');
    }

    public function showCart(Request $request)
    {
        $id = $request->session()->get('user_id');
        $cart = User::find($id)->cart;
        return view('carts.order',compact('cart'));
    }
    public function order(Request $request)
    {
         $id = $request->session()->get('user_id');
         $order = new Order();
         $order->user_id = $id;
         $order->save();
         $cart = User::find($id)->cart;
         foreach($cart->cartProducts as $cart_product)
         {
             $orderProduct = new OrderProduct();
             $orderProduct->order_id = $order->id;
             $orderProduct->product_id = $cart_product->product_id;
             $orderProduct->quantity = $cart_product->quantity;
             $orderProduct->price = $cart_product->product->price;
             $orderProduct->save();
         }
         $cart->delete();
         return redirect('users/home')->with('success','Order success');
    }

    public function showOrder(Request $request)
    {
        $id = $request->session()->get('user_id');
        $user = User::find($id);
        return view('carts.show',compact('user'));
    }

    public function showOrderDetail($id)
    {
        //find order
        $order = Order::find($id);
        return view('carts.orderDetail',compact('order'));
    }
}
