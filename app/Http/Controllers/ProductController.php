<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
  public function getIndex()
  {
    $products = Product::all();
    return view('shop.index', ['products' => $products]);
  }

  public function getAddToCart(Request $request, $id)
  {
    $product = Product::find($id);
    $existingCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($existingCart);
    $cart->add($product);
    $request->session()->put('cart', $cart);

    return redirect()->route('product.index');
  }

}
