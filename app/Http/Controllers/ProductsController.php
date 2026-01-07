<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    // public function index(){
    //     return view('index');
    // }

    public function detail(){
        print_r(route('products'));
        return view('products.index');
        // $product = [
        //     'iphone' => 'iPhone 14 Pro',
        //     'samsung' => 'Samsung S23 Ultra',
        // ];
        // return view('products.index',[
        //     'product' => $product[$productName]
        // ]);
    }
}
