<?php

namespace App\Http\Controllers;

use Mail;
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
        //
        $this->middleware('admin.check')->only('listUser', 'adminLogout', 'adminEdit', 'adminUpdate', 'destroy');
        $this->middleware('user.check')->only('edit', 'update');
        $this->middleware('sendData');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->session()->has('admin_id')) {
            $request->session()->forget('admin_id');
        }
        $womenCategories = Category::all()->where('trademark', '=', 'Woman');
        $arrayCategoryWomanId = array();
        foreach ($womenCategories as $womanCategory) {
            array_push($arrayCategoryWomanId, $womanCategory->id);
        }
        $productWoman = Product::all()->whereIn('category_id', $arrayCategoryWomanId);
        $manCategories = Category::all()->where('trademark', '=', 'Man');
        $arrayCategoryManId = array();
        foreach ($manCategories as $manCategory) {
            array_push($arrayCategoryManId, $manCategory->id);
        }
        $productMan = Product::all()->whereIn('category_id', $arrayCategoryManId);
        $kidCategories = Category::all()->where('trademark', '=', 'Kid');
        $arrayCategoryKidId = array();
        foreach ($kidCategories as $kidCategory) {
            array_push($arrayCategoryKidId, $kidCategory->id);
        }
        $productKid = Product::all()->whereIn('category_id', $arrayCategoryKidId);
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
        $x = str_random(20);
        while (true) {
            $u = User::where('email_confirm_token', '=', $x)->first();
            if ($u != null) {
                $x = str_random(20);
            } else {
                break;
            }
        }
        $y = str_random(20);
        while (true) {
            $u = User::where('password_reset_token', '=', $y)->first();
            if ($u != null) {
                $y = str_random(20);
            } else {
                break;
            }
        }
        User::create($user);
        $user1 = User::where('email', '=', $user['email'])->first();
        $user1->email_confirm_token = $x;
        $user1->password_reset_token = $y;
        $user1->save();
        $email = $user['email'];
        $name = $user['name'];
        $link = "ninh.com/user/confirm/". $x;
        $data = array('email' => $user['email'], 'name' => $user['name'],'link' => $link);
        Mail::send('users.contentEmail', $data, function ($message) use ($data) {
        
            $message->to($data['email'], 'HaiNinh')->subject('Confirm email!');
        });
        if ($request->session()->has('admin_id')) {
            return redirect('admin/products');
        } else {
            return redirect('users/home');
        }

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
        $id = $request->session()->get('user_id');
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user->name = $request->input('name');
            $user->password = bcrypt($request->input('newpassword'));
            $user->save();
            return redirect('users/edit')->with('success', 'Edit success');
        } else {
            return redirect('users/edit')->withErrors('Password not same old password');
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
        return redirect('admin/listUser');
    }

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
        if (Auth::attempt(['email' => $email, 'password' => $password, 'rules' => 0])) {
            $user = DB::table('users')->where([
              ['email', '=', $email]
            ])->first();
            $request->session()->put('user_id', $user->id);
            $request->session()->put('name', $user->name);
            if ($request->session()->get('review') == 1) {
                $id = $request->session()->get('id');
                $request->session()->forget('id');
                $request->session()->forget('review');
                return redirect('products/'. $id);
            } elseif ($request->session()->has('products')) {
                $cart = Cart::find($request->session()->get('user_id'));
                if ($cart == null) {
                    $cart = new Cart();
                    $cart->user_id = $request->session()->get('user_id');
                    $cart->save();
                }
                $arrays = $request->session()->get('products');
                for ($i = 0; $i < count($arrays); $i++) {
                //kiem tra co cartproduct chua neu chua co thi tao moi con neu co roi thi so luong se bang cong don
                    $cartProduct = CartProduct::find($arrays[$i]['id']);
                    if ($cartProduct == null) {
                        $cartProduct = new CartProduct();
                        $cartProduct->cart_id = $cart->id;
                        $cartProduct->product_id = $arrays[$i]['id'];
                        $cartProduct->quantity = $arrays[$i]['number'];
                        $cartProduct->save();
                    } else {
                        $cartProduct->quantity = $cartProduct->quantity + $arrays[$i]['number'];
                    
                    }
                }
                $request->session()->forget('products');
                return redirect('carts/showCart');
            } else {
                return redirect()->route('home', ['products' => $products]);
            }
        } else {
            return redirect('users/login')->with('success', 'Login fails');
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
        return view('users.listUser', compact('users'));
    }

    public function adminEdit($id)
    {
        $user = User::find($id);
        return view('users.adminEdit', compact('user'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();
        return redirect('admin/listUser');
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->forget('name_admin');
        return redirect('admin/login');
    }

   
    public function adminLogin()
    {
        return view('users.adminLogin');
    }

    public function adminPostLogin(Request $request)
    {
       
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'rules' => 1])) {
            $user = DB::table('users')->where([
                   ['email', '=', $email]
            ])->first();
            $request->session()->put('admin_id', $user->id);
            $request->session()->put('name_admin', $user->name);
            return redirect('admin/products');
        } else {
            return redirect('admin/login')->with('success', 'Login fails');
        }
    }

    public function confirmEmail($email_confirm_token)
    {
        $user = User::where('email_confirm_token', '=', $email_confirm_token)->first();
        $user->flag = 1;
        $user->save();

        $data = array('email' => $user['email'], 'name' => $user['name']);
        Mail::send('users.successConfirm', $data, function ($message) use ($data) {
        
            $message->to($data['email'], 'HaiNinh')->subject('Success Confirm!');
        });
        return redirect('users/home');
    }

    public function getFormSendMail()
    {
        return view('users.sendMail');
    }

    public function postFormSendMail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', '=', $email)->first();
        if ($user != null) {
            $link = "ninh.com/user/resetpassword/". $email. "/". $user->password_reset_token;
            $data = array('email' => $email,'link' => $link);
            Mail::send('users.createNewPassword', $data, function ($message) use ($data) {
            
                $message->to($data['email'], 'HaiNinh')->subject('Create new password!');
            });
    
            return view('users.resultSendMail', compact('email'));
        } else {
            return redirect('user/sendMail')->withErrors('User khong ton tai');
        }
    }

    public function getFormNewPassword($email, $token)
    {
        $user = User::where('email', '=', $email)->where('password_reset_token', '=', $token)->first();
        if ($user != null) {
            return view('users.formNewPassword', compact('email', 'token'));
        } else {
            return redirect('users/home');
        }
    }

    public function postNewPassword(Request $request, $email, $token)
    {
        $user = User::where('email', '=', $email)->where('password_reset_token', '=', $token)->first();
        $this->validate(request(), [
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password'
        ]);
        if ($user != null) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return redirect('user/resetPwdSuccess');
        } else {
            return redirect('users/home');
        }
    }
    public function getResetPwdSuccess()
    {
        return view('users.resetPwdSuccess');
    }
}
