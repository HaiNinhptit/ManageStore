<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Config;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\User;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.check')->except('show','search','searchByCategory','searchByDetail');
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
        $request->session()->put('search',1);
        $request->session()->put('search_content',$content);
        $products = Product::Where('name', 'like', '%' . $content . '%')->paginate(6);
        return view('pages.search', compact('products'));
    }

    public function searchByCategory(Request $request, $category_id = 0)
    {
        
        if($category_id == 0 && $request->session()->get('search_content'))
        {   
            $content = $request->session()->get('search_content');
            $sortBy = $request->input('sortBy');
            $limit = $request->input('limit');
            $request->session()->put('sortBy',$sortBy);
            $request->session()->put('limit',$limit);
        
            if($sortBy == 0)
            {
                $request->session()->put('search',1);
                $products = Product::where('name', 'like', '%' . $content . '%')->paginate($limit);              
            }
    
            if($sortBy == 1)
            {
                $request->session()->put('search',1);
                $products = Product::where('name', 'like', '%' . $content . '%')->orderBy('name', 'asc')->paginate($limit);                               
            }
    
    
            if($sortBy == 2)
            {
                $request->session()->put('search',1);
                $products = Product::where('name', 'like', '%' . $content . '%')->orderBy('name', 'desc')->orderBy('name', 'desc')->paginate($limit);                               
            
            }
    
    
            if($sortBy == 3)
            {
                $request->session()->put('search',1);
                $products = Product::where('name', 'like', '%' . $content . '%')->orderBy('price', 'asc')->orderBy('price', 'asc')->paginate($limit);                               
            }
    
    
            if($sortBy == 4)
            {
                $request->session()->put('search',1);
                $products = Product::where('name', 'like', '%' . $content . '%')->orderBy('price', 'desc')->orderBy('price', 'desc')->paginate($limit);                               
            } 
            $products->setPath('searchByCategory?&search='.$content.'&limit='.$limit.'&sortBy='.$sortBy);
        }
        elseif ($request->input('search1') != NULL ||$request->input('limit') != NULL || $request->input('sortBy') != NULL){
            $content = $request->input('search1');
            $sortBy = $request->input('sortBy');
            $limit = $request->input('limit');
            $category_id = $request->input('category_id');
            $request->session()->put('sortBy',$sortBy);
            $request->session()->put('limit',$limit);
            $request->session()->put('content1',$content);
            if($sortBy == 0)
            {
                $request->session()->forget('search_content');
                $products = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $content . '%')->paginate($limit); 
                             
            }
    
            if($sortBy == 1)
            {
                $request->session()->forget('search_content');
                $products = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $content . '%')->orderBy('name', 'asc')->paginate($limit);                               
            }
    
    
            if($sortBy == 2)
            {
                $request->session()->forget('search_content');
                $products = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $content . '%')->orderBy('name', 'desc')->orderBy('name', 'desc')->paginate($limit);                               
            
            }
    
    
            if($sortBy == 3)
            {
                $request->session()->forget('search_content');
                $products = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $content . '%')->orderBy('price', 'asc')->orderBy('price', 'asc')->paginate($limit);                               
            }
    
    
            if($sortBy == 4)
            {
                $request->session()->forget('search_content');
                $products = Product::where('category_id', '=', $category_id)->where('name', 'like', '%' . $content . '%')->orderBy('price', 'desc')->orderBy('price', 'desc')->paginate($limit);                               
            } 
            $products->setPath('searchByCategory?&search1='.$content.'&limit='.$limit.'&sortBy='.$sortBy.'&category_id='.$category_id);
        }
        else{
            $products = Product::where('category_id', '=', $category_id)->paginate(3); 
            $request->session()->forget('search_content');
        }
        return view('pages.search', compact('products','category_id'));
    }

}
