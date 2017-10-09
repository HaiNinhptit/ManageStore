<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Product;
use Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('session.check')->except('store','create','login','postLogin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('pages.home', compact('products'));
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
        $id = $request->session()->get('id');
        $user = User::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'password' => 'required',
            'newpassword' => 'required|min:8',
            'enternewpassword' => 'required|same:newpassword'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if(Auth::attempt(['email' => $email, 'password' =>$password]))
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
       if(Auth::attempt(['email' => $email, 'password' => $password]))
       {
          $user = DB::table('users')->where([
              ['email', '=', $email]
          ])->first();
          $request->session()->put('user_id',$user->id);
          $request->session()->put('name',$user->name);
          //return view('pages.home',compact('products'));
          return redirect()->route('home', ['products'=>$products]);
       }
       else
       {
           return redirect('users/login')->with('success','Email or Password wrong');
       }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        return redirect('users/login');

    }
}
