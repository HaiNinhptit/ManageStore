<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\WarehousingDetail;
use Carbon;
use App\ActiveProduct;

class WarehousingController extends Controller
{
    //
    public function create()
    {
        //get list product
        $products = Product::all();
        return view('warehousings.add', compact('products'));
    }

    public function store(Request $request)
    {
        $warehousing = $this->validate(request(), [
            'product_id' => 'required|integer',
            'quantity' => 'required',
            'price' => 'required',
            'date' => 'required|date',
        ]);
        //format date
        $date = Carbon\Carbon::parse($request->input('date'))->format('Y-m-d');
        $warehousing['date'] = $date;
        WarehousingDetail::create($warehousing)->with('success', 'Add success');
        //add activeProduct
        //check activeProduct of product
        $activeProduct = ActiveProduct::where('product_id', '=', $warehousing['product_id'])->first();
        if ($activeProduct == NULL) {
            $activeProduct = new ActiveProduct();
            $activeProduct->product_id = $warehousing['product_id'];
            $activeProduct->quantity = $warehousing['quantity'];
        } else {
            $activeProduct->quantity += $warehousing['quantity'];        
        }
        $activeProduct->save();
    }

    public function index()
    {
        $listDateWarehousings = WarehousingDetail::distinct('date')->select('date')->get()->toArray();
        return view('warehousings.index', compact('listDateWarehousings'));   
    }
    
    public function detailWarehousing($date)
    {
        $listProductWarehousings = WarehousingDetail::Where('date', '=', $date)->get()->toArray();
        return view('warehousings.detail', compact('listProductWarehousings'));
    }

    public function getFormEdit($id)
    {
        $products = Product::all();
        $warehousingDetail = WarehousingDetail::find($id);
        return view('warehousings.edit', ['products' => $products, 'warehousingDetail' => $warehousingDetail]);
        
    }

    public function update(Request $request, $id)
    {
        $warehousingDetail = WarehousingDetail::find($id);
        $this->validate(request(), [
            'product_id' => 'required|integer',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $warehousingDetail->product_id = $request->input('product_id');
        $warehousingDetail->quantity = $request->input('quantity');
        $warehousingDetail->price = $request->input('price');
        $warehousingDetail->save();
        return redirect('admin/warehousing/detailProduct/'. $id)->with('success','edit success');
    }

    public function delete($id)
    {
        $warehousingDetail = WarehousingDetail::find($id);
        $warehousingDetail->delete();
        return back();

    }

}
