<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use App\OrderProduct;
use App\CartProduct;
class GuestController extends Controller
{
    //
    public function update(Request $request, $id)
    {
        $arrays = $request->session()->get('products');
        for($i = 0; $i < count($arrays); $i++)
        {
            if($arrays[$i]['id'] == $id)
            {
                $arrays[$i]['number'] = $request->input('quantity');
            }
        }
        $request->session()->put('products', $arrays);
        return redirect('carts')->with('success','Update success');
    }

    public function destroy(Request $request, $id)
    {
        $arrays = $request->session()->get('products');
        for($i = 0; $i < count($arrays); $i++)
        {
            if($arrays[$i]['id'] == $id)
            {
                unset($arrays[$i]);
                $arrays = array_values($arrays);
            }
        }
        $request->session()->put('products', $arrays);
        return redirect('carts')->with('success','Delete success');
    }

    public function showCart(Request $request)
    {
       $cart = new Cart();
       $arrays = $request->session()->get('products');
       $tong = 0;
       for($i = 0; $i < count($arrays); $i++)
       {
           $tong+= $arrays[$i]['price'] * $arrays[$i]['number'];
       }
       return view('carts.order',compact('cart','arrays','tong'));
    }

    public function checkOrder(Request $request)
    {
        if($request->session()->has('user_id'))
        {
            //tao ca bang cart
            // $cart = new Cart();
            // $cart->user_id = $request->session()->get('user_id');
            // $cart->save();
            $arrays = $request->session()->get('products');
            //tao bang order va order product order co them user_id
            $order = new Order();
            $order->user_id = $request->session()->get('user_id');
            $order->save();
            for($i = 0; $i < count($arrays); $i++)
            {
                //tao cac cartproduct
                // $cartProduct = new CartProduct();
                // $cartProduct->cart_id = $cart->id;
                // $cartProduct->product_id = $arrays[$i]['id'];
                // $cartProduct->quantity = $arrays[$i]['number'];
                // $cartProduct->save();

                //order_id , product_id, price, quantity
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $arrays[$i]['id'];
                $orderProduct->price = $arrays[$i]['price'];
                $orderProduct->quantity = $arrays[$i]['number'];
                $orderProduct->save();
            }
            $request->session()->forget('products');
            return redirect('users/home')->with('success','Order success');
        }
        else
        {
            return redirect('users/login');
        }    
    }
}
