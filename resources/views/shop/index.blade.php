@extends('layouts.master')

@section('title')
  Shopping Cart
@endsection
@section('content')
  <div class="row">
    @foreach($products as $product)
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="" alt="{{ $product->title }}" class="img-responsive">
          <div class="caption">
            <h3>{{ $product->title }}</h3>
            <p class="description">{{ $product->description }}</p>
            <div class="clearfix">
              <div class="pull-left price">$ {{ $product->price }}</div>
              <a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
