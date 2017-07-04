<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function getSignup() {
    return view('user.signup');
  }

  public function postSignup(Request $request) {
    // if invalid implicitly return
    $this->validate($request, [
      'email' => 'email|required|unique:users',
      'password' => 'required|min:4'
    ]);

    // valid only
    $user = new User([
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password'))
    ]);
    $user->save();

    return redirect()->route('product.index');
  }
}
