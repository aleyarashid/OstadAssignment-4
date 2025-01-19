@extends('layouts')

@section('content')


           
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                <h1 class="card-title text-center mb-2">Product Management</h1>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 mb-4 d-flex justify-content-center">
                        <input type="text" id="search" class="form-control" placeholder="Search Product..." >

                    </div>

                    <div class="d-grid gap-2 mb-2 d-flex justify-content-end"><a href="{{ route('product.create') }}" class="btn btn-primary"> <i class="bi bi-plus"></i> Create Product</a></div>
                    @session('success')
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                @endsession

                    <table class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Product ID</i></th>
                                <th class="text-center"><a href="{{ route('products.list', ['sortBy' => 'name', 'sort' =>request('sort') == 'asc' ? 'desc' : 'asc']) }}">Product Name <i class="bi {{request('sortBy') == 'name' && request('sort') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down'}}"></i></a></th>
                                <th class="text-center">Description</th>
                                <th class="text-center"><a href="{{ route('products.list', ['sortBy' => 'price', 'sort' =>request('sort') == 'asc' ? 'desc' : 'asc'])}}">Price</a><i class="bi {{request('sortBy') == 'price' && request('sort') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down'}}"></i></th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                      
                        
                            @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                            <td class="text-center"><p class=" align-items-center">{{ $product->product_id }}</p></td>
                            <td class="text-center"><p class=" align-items-center">{{ $product->name }}</p></td>
                            <td class="text-center"><p class=" align-items-center">{{ $product->description }}</p></td>
                            <td class="text-center"><p class=" align-items-center">{{ $product->price }}</p></td>
                            <td class="text-center"><p class=" align-items-center">{{ $product->stock }}</p></td>
                            <td class="text-center"><img src="{{ asset('images/'.$product->image) }}" class="img-thumbnail align-items-center" width="100"" alt=""></td>
                            <td class="text-center align-items-center">
                            <form action="{{route('product.delete', $product->id)}}" method="post">
                                <a href="{{ route('product.show', $product->id)}}" class="btn btn-info shadow btn-xs sharp">
                                    <i class="bi bi-archive"></i>&nbspShow</a>
                                <a href="{{ route('product.edit', $product->id)}}" class="btn btn-success shadow btn-xs sharp"><i class="bi bi-pencil-square"></i>&nbspEdit</a>
                                
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="bi bi-trash"></i>&nbspDelete</button>
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach
                       
                         
                   </table>     
                   {!! $products->withQueryString()->links('pagination::bootstrap-5')!!}
                </div>
            </div>
        </div>    
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('#search').on('input', function(){
            let query = $(this).val();
            $.ajax({
                url: "{{ route('products.search') }}",
                type: 'GET',
                data: { 'query': query },
                success: function(data){
                    $('tbody').html(data);
                },
                error: function(){
                    alert('Search Failed. Please try again.');
                }
            });
        });
     });
</script>
@endsection