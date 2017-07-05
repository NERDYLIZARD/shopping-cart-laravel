<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function getSignup() {
    return view('user.signup');
  }

  public function postSignup(Request $request) {
    // return redirect()->back() with error messages if invalid
    $this->validate($request, [
      // order matters
      'email' => 'required|email|unique:users',
      'password' => 'required|min:4'
    ]);

    // valid only
    $user = new User([
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password'))
    ]);
    $user->save();
    Auth::login($user);
    return redirect()->route('user.profile');
  }

  public function getSignin() {
    return view('user.signin');
  }

  public function postSignin(Request $request) {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if (Auth::attempt([
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ])) {
      return redirect()->route('user.profile');
    }
    return redirect()->back()->withErrors(['incorrect email or password']);
  }

  public function getProfile() {
    return view('user.profile');
  }

  public function getLogout() {
    Auth::logout();
    return redirect()->route('product.index');
  }

}
