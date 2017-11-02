<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $womenCategories = Category::all()->where('trademark', '=', 'Woman');
        $arrayCategoryWomanId = array();
        foreach($womenCategories as $womanCategory)
        {
            array_push($arrayCategoryWomanId, $womanCategory->id);
        }
        $productWoman = Product::all()->whereIn('category_id', $arrayCategoryWomanId);

        $manCategories = Category::all()->where('trademark', '=', 'Man');
        $arrayCategoryManId = array();
        foreach($manCategories as $manCategory)
        {
            array_push($arrayCategoryManId, $manCategory->id);
        }
        $productMan = Product::all()->whereIn('category_id', $arrayCategoryManId);

        $kidCategories = Category::all()->where('trademark', '=', 'Kid');
        $arrayCategoryKidId = array();
        foreach($kidCategories as $kidCategory)
        {
            array_push($arrayCategoryKidId, $kidCategory->id);
        }
        $productKid = Product::all()->whereIn('category_id', $arrayCategoryKidId);
        return view('pages.home', compact('productWoman', 'productMan', 'productKid'));
    }
}
