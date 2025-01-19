@extends('layouts')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title text-center">Product Details</h2>
            </div>
            <div class="card-body">
            <div class="d-grid gap-2 mb-2 d-flex justify-content-end"><a href="{{ route('products.list') }}" class="btn btn-primary"> <i class="bi bi-arrow-left"></i></i> Back</a></div>
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> {{ $product->price }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <p><strong>Image:</strong> <img src="{{ asset('images/'.$product->image) }}" class="img-thumbnail align-items-center" width="300"" alt=""></p>
            </div>
        </div>
        </div>
    </div>
@endsection