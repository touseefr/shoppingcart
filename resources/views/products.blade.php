@extends('layout/app')

@section('content')
  <div class="container">
  <h1 class="text-center">Products Page</h1>
    <div class="row">
     
      <div class="card-deck">
         @if(count($products)>0)
          @foreach($products as $product)
            <div class="card">
              <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top" height="170px">
              <div class="card-header">
              {{$product->name}}
              <span class="float-right">{{ $product->prize }}</span>
            </div>
             <div class="card-body">
              <p> {{!! $product->description !!}}</p> 
             </div>
             <div class="card-footer">
                 <!-- <a href="{{ route('add.card',['product' => $product->id] )}}" class="btn btn-success btn-block">Add To Cart</a> -->
                 <a href="" class="btn btn-success btn-block">Add To Cart</a>
             </div>
            </div>
          
          @endforeach
         @endif
      </div>
    </div>
  </div>
@endsection