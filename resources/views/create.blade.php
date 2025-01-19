@extends('layouts')

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Create Product</h2>
        </div>
        <div class="card-body">
           
        <div class="d-grid gap-2 mb-2 d-flex justify-content-end"><a href="{{ route('products.list') }}" class="btn btn-primary"> <i class="bi bi-arrow-left"></i></i> Back</a></div>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label class="form-label" for="p_name">Product Name:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name....." id="p_name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group  mb-4">
                    <label class="form-label" for="desp">Product Description:</label>
                    <textarea name="description" id="desp" placeholder="Product Description....." class="form-control"></textarea>
                </div>
                <div class="form-group mb-4 col-lg-6">
                    <label class="form-label" for="price">Price:</label>
                    <input type="number" name="price" placeholder="Product Price....." class="form-control @error('price') is-invalid @enderror" id="price">
                    @error('price')
                        <span class="invalid-feedback" role="alert">    
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-4 col-lg-6">
                    <label class="form-label" for="stock">Stock:</label>
                    <input type="number" name="stock" placeholder="Product Stock....." class="form-control" id="stock">
                </div>
                <div class="form-group mb-4">
                    <label class="form-label" for="image">Image Upload:</label>
                    <input type="file" name="image" placeholder="Upload Product Image....." class="form-control @error('image') is-invalid @enderror" id="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-4 m-auto">
                    <button type="submit" class="btn btn-primary w-25 ">Add Product</button>
                </div>
            </form>
        </div>
            
    </div>
</div>
@endsection
