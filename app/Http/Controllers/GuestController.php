<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use App\OrderProduct;
use App\CartProduct;
use App\User;
class GuestController extends Controller
{
    //
    public function __construct()
    {
        //
        $this->middleware('sendData');
    }

    public function update(Request $request, $id)
    {
        //
        $arrays = $request->session()->get('products');
        for($i = 0; $i < count($arrays); $i++)
        {
            if($arrays[$i]['id'] == $id)
            {
                $arrays[$i]['number'] = $request->input('quantity');
            }
        }
        $request->session()->put('products', $arrays);
        return redirect('carts')->with('success', 'Update success');
    }

    public function destroy(Request $request, $id)
    {
        //
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
        return redirect('carts')->with('success', 'Delete success');
    }

    public function showCart(Request $request)
    {
        //
       return view('carts.order');
    }

    public function checkOrder(Request $request)
    {
        //
        if($request->session()->has('user_id'))
        {
            //tao bang order va order product order co them user_id lay san pham trong gio hang vi vao day thi xoa session('products')
            $order = new Order();
            $order->user_id = $request->session()->get('user_id');
            $order->save();
            $cart = User::find($request->session()->get('user_id'))->cart;
            foreach ($cart->cartProducts as $cartProduct)
            {
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $cartProduct->product_id;
                $orderProduct->price = $cartProduct->product->price;
                $orderProduct->quantity = $cartProduct->quantity;
                $orderProduct->save();
            }
            $cart->delete();
            return redirect('users/home');
        }
        else
        {
            return redirect('users/login');
        }    
    }
}
