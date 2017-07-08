<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;


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

  public function getCart()
  {
    if (!Session::has('cart'))
      return view('shop.cart');

    $cart = new Cart(Session::get('cart'));
    return view('shop.cart', [
      'items' => $cart->items,
      'totalPrice' => $cart->totalPrice
    ]);
  }

  public function getCheckout()
  {
    if (!Session::has('cart'))
      return view('shop.cart');

    $cart = new Cart(Session::get('cart'));
    return view('shop.checkout', ['totalPrice' => $cart->totalPrice]);
  }


  public function postCheckout(Request $request)
  {
    if (!Session::has('cart'))
      return view('shop.cart');

    $cart = new Cart(Session::get('cart'));
    Stripe::setApiKey('sk_test_gnl471KUNlqnivfEfxKW5SNo');
    try {
      $charge = Charge::create([
        "amount" => $cart->totalPrice * 100,
        "currency" => "usd",
        "source" => $request->input('stripeToken'),
        "description" => "test charge"
      ]);
      $order = new Order();
      $order->cart = serialize($cart);
      $order->name = $request->input('name');
      $order->address = $request->input('address');
      $order->payment_id = $charge->id;

      Auth::user()->orders()->save($order);

    } catch (\Exception $e) {
      redirect()->route('product.cart.checkout')->withErrors($e->getMessage());
    }

    Session::forget('cart');
    return redirect()->route('product.index')->with('success', 'Successfully purchased products');
  }

}
