<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Cart;
use App\CartProduct;
use App\Category;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.check')->only('listUser', 'adminLogout', 'adminEdit', 'adminUpdate');
        $this->middleware('user.check')->only('edit', 'update', 'destroy');
        $this->middleware('sendData');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $womenCategories = Category::all()->where('trademark', '=', 'Woman');
        $arrayCategoryWomanId = array();
        foreach($womenCategories as $womanCategory)
        {
            array_push($arrayCategoryWomanId, $womanCategory->id);
        }
        $productWoman = Product::all()->whereIn('category_id',$arrayCategoryWomanId);

        $manCategories = Category::all()->where('trademark', '=', 'Man');
        $arrayCategoryManId = array();
        foreach($manCategories as $manCategory)
        {
            array_push($arrayCategoryManId, $manCategory->id);
        }
        $productMan = Product::all()->whereIn('category_id',$arrayCategoryManId);

        $kidCategories = Category::all()->where('trademark', '=', 'Kid');
        $arrayCategoryKidId = array();
        foreach($kidCategories as $kidCategory)
        {
            array_push($arrayCategoryKidId, $kidCategory->id);
        }
        $productKid = Product::all()->whereIn('category_id',$arrayCategoryKidId);
        return view('pages.home', compact('productWoman', 'productMan', 'productKid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user['password'] = bcrypt($user['password']);
        $user['rules'] = 0;
        User::create($user);
        return redirect('users/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $id =$request->session()->get('user_id');
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $request->session()->get('user_id');
        $user = User::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'password' => 'required',
            'newpassword' => 'required|min:8',
            'enternewpassword' => 'required|same:newpassword'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            $user->name = $request->input('name');
            $user->password = bcrypt($request->input('newpassword'));        
            $user->save();   
            return redirect('users/edit')->with('success','Edit success');
        }
        else
        {
            return redirect('users/edit')->with('success','Password not same old password');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return redirect('users/listUser');
    }

    //get login
    public function login()
    {
        return view('users.login');
    }

    public function postLogin(Request $request)
    {
       $products = Product::all();
       $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
       ]);
       $email = $request->input('email');
       $password = $request->input('password');
       if(Auth::attempt(['email' => $email, 'password' => $password, 'rules' => 0]))
       {
          $user = DB::table('users')->where([
              ['email', '=', $email]
          ])->first();
          $request->session()->put('user_id',$user->id);
          $request->session()->put('name',$user->name);
          if($request->session()->get('review')==1)
          {
              $id = $request->session()->get('id');
              $request->session()->forget('id');
              $request->session()->forget('review');
              return redirect('products/'.$id);
          }
          elseif ($request->session()->has('products'))
          {
               //kiem tra xem co gio hang chua
            $cart = Cart::find($request->session()->get('user_id'));  
            if($cart == NULL)
            {
                $cart = new Cart();
                $cart->user_id = $request->session()->get('user_id');
                $cart->save();  
            }
            $arrays = $request->session()->get('products');
            for($i = 0; $i < count($arrays); $i++)
            {
                //kiem tra co cartproduct chua neu chua co thi tao moi con neu co roi thi so luong se bang cong don
                $cartProduct = CartProduct::find($arrays[$i]['id']);
                if($cartProduct == NULL)
                {
                    $cartProduct = new CartProduct();
                    $cartProduct->cart_id = $cart->id;
                    $cartProduct->product_id = $arrays[$i]['id'];
                    $cartProduct->quantity = $arrays[$i]['number'];
                    $cartProduct->save();
                    
                }
                else
                {
                    $cartProduct->quantity = $cartProduct->quantity + $arrays[$i]['number'];
                    
                }
            }
            $request->session()->forget('products');
            return redirect('carts/showCart');
          }
          else
          {
             return redirect()->route('home', ['products'=>$products]);
          }
       }
       elseif (Auth::attempt(['email' => $email, 'password' => $password, 'rules' => 1]))
       {    $user = DB::table('users')->where([
                ['email', '=', $email]
            ])->first();
            $request->session()->put('admin_id',$user->id);
            $request->session()->put('name_admin',$user->name);
            return redirect('products');
       }
       else
       {
           return redirect('users/login')->with('success','Login fails');
       }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('name');
        $request->session()->forget('products');
        return redirect('users');

    }
    public function listUser()
    {
        $users = User::Where('rules', '=', 0)->get();
        return view('users.listUser',compact('users')); 
    }

    public function adminEdit($id)
    {
       $user = User::find($id);
       return view('users.adminEdit',compact('user'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
       ]);
       $user = User::find($id);
       $user->name = $request->input('name');
       $user->save();
       return redirect('users/listUser');
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->forget('name_admin');
        return redirect('users/login');
    }

    public function demo()
    {
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
        var_dump($categoryByTrademarks);
        die();

    }
}
