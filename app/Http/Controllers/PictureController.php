<?php

namespace App\Http\Controllers;
use App\Picture;
use App\Product;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.check');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pictures = Picture::all()->toArray();
        return view('pictures.index',compact('pictures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all()->toArray();
        return view('pictures.add',compact('products'));
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
        $picture = $this->validate(request(), [
            'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_id' => 'required|integer'
        ]);  

        $picture['name'] = $request->file('name')->getClientOriginalName();
        Picture::create($picture);
        $request->file('name')->move('images/products',$request->file('name')->getClientOriginalName());
        return redirect('pictures/create')->with('success','Add success');
        
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
    public function edit($id)
    {
        //
        $products = Product::all()->toArray();
        $picture = Picture::find($id);
        return view('pictures.edit',compact('products'),['picture'=>$picture]);

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
        $this->validate(request(),[
            'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $picture = Picture::find($id);
        $picture->name = $request->file('name')->getClientOriginalName();
        $picture->save();
        $request->file('name')->move('images/products',$request->file('name')->getClientOriginalName());
        return redirect('pictures');
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
        $picture = Picture::find($id);
        $picture->delete();
        return redirect('pictures');
    }
}
