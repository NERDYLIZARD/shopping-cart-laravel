@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <h1>Sign In</h1>
      @include('common.errors')

      <form action="{{ route('user.signin') }}" method="post">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input id="email" name="email" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" class="form-control">
        </div>
        <button class="btn btn-primary">Sign In</button>
        <p>Don't have the account? <a href="{{ route('user.signup') }}">Sign Up Here!!</a></p>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
@endsection