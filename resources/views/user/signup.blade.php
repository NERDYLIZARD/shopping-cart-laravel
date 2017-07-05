@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-4 col-md-offset-4">

    <h1>Sign Up</h1>

    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('user.signup') }}" method="post">
      <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="text" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" class="form-control">
      </div>
      <button class="btn btn-primary">Sign Up</button>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection