<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.check')->except('show','search','searchByCategory');
        $this->middleware('sendData');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all()->toArray();
        return view('products.index', compact('products'));
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all()->toArray();
        return view('products.add', compact('categories'));
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
        $product = $this->validate(request(), [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required|integer'
        ]);
        Product::create($product);
        return redirect('products/create')->with('success','Add success');
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
        $product = Product::find($id);
        $comments = $product->comments;
        return view('products.detail',compact('comments','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all()->toArray();
        $product = Product::find($id);
        return view('products.edit',compact('categories'),['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        $this->validate(request(),[
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->get('category_id');
        $product->save();
        return redirect('products/'.$id.'/edit')->with('success','Edit success');
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
        $product = Product::find($id);
        $product->delete();
        return redirect('products');
    }

    public function search(Request $request)
    {
        $content = $request->input('search');
        $products = Product::Where('name', 'like', '%' . $content . '%')->orWhere('description', 'like', '%' . $content . '%')->get();
        return view('pages.search', compact('products'));
    }

    public function searchByCategory($category_id)
    {
        $category = Category::find($category_id);
        $products = $category->products;
        return view('pages.search', compact('products'));
    }
}
