<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\View;
use App\User;
use App\Product;
use App\Category;
use Closure;

class SendData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //co tai khoan dang nhap thi truyen vao gio hang
        if($request->session()->has('user_id'))
        {
            $cart = User::find($request->session()->get('user_id'))->cart;
            if($cart != NULL)
            {
                View::share('cart',$cart); 
            }
        }

        //chua co tai khoan dang nhap thi truyen danh sach san pham
        //products la danh sach san pham
        //productCart la mang cac doi tunog san pham trong gio hang tuong duong voi mang products
        //total la tong tien cua gio hang do
        //count la dem tong so san pham trong gio hang
        if($request->session()->has('products'))
        {
            $count = 0;
            $total = 0;
            $products = $request->session()->get('products');
            $productCart = array();
            foreach ($products as $product)
            {
                $count += $product['number'];
                $total += $product['number'] * $product['price'];
                $_product = Product::find($product['id']);
                array_push($productCart,$_product);
            }
            View::share(['total'=> $total, 'count' => $count,'products' => $products, 'productCart' => $productCart]);
        }

        $categories = Category::select('trademark')->distinct()->get();
        $trademarks = array();  //mang cac trademark co 3 phan tu : woman,man,kid
        foreach ($categories as $category)
        {
            array_push($trademarks, $category->trademark);
        }

        $categoryByTrademarks = array();
        foreach($trademarks as $trademark)
        {
            $categories = Category::all()->where('trademark', '=', $trademark)->toArray();
            array_push($categoryByTrademarks,$categories);
         
        }
        View::share('categoryByTrademarks', $categoryByTrademarks);
        return $next($request);
    }
}
