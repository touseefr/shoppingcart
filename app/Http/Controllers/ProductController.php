<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products')->with('products', Product::all());
    }
    public function index2()
    {
        return view('p2')->with('products', Product::all());
    }
    public function cart()
    {
        return view('cart');
    }

    public function addtocart(Product $product)
    {
        $cart = session()->get('cart');
        if(!$cart)
        {
            $cart=[
              $product->id=[
                  'name' => $product->name,
                   "quantity" => '1',
                   'prize' =>$product->prize,
                   'image' => $product->image
              ]
            ];
            session()->put('cart',$cart);
            return redirect('/cart')->with('success','Added to Cart');
        }

        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity']++;
            session()->put('cart',$cart);
            return redirect('/cart')->with('success','Added to Cart');
        }
        $cart[$product->id]=[
            'name' => $product->name,
            "quantity" => '1',
            'prize' =>$product->prize,
            'image' => $product->image
        ];
        session()->put('cart',$cart);
        return redirect('/cart')->with('success','Added to Cart');
    }

    public function removefromcart($id)
    {
        $cart = session()->get('cart');
      // dd($cart[$id]);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', "Removed from Cart");
    }
}
