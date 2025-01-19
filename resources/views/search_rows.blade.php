@foreach ($products as $product)
    <tr>
        <td class="text-center"><p class=" align-items-center">{{ $product->id }}</p></td>
        <td class="text-center"><p class=" align-items-center">{{ $product->product_id }}</p></td>
        <td class="text-center"><p class=" align-items-center">{{ $product->name }}</p></td>
        <td class="text-center"><p class=" align-items-center">{{ $product->description }}</p></td>
        <td class="text-center"><p class=" align-items-center">{{ $product->price }}</p></td>
        <td class="text-center"><p class=" align-items-center">{{ $product->stock }}</p></td>
        <td class="text-center"><img src="{{ asset('images/'.$product->image) }}" class="img-thumbnail align-items-center" width="100"" alt=""></td>
        <td class="text-center align-items-center">
            <a href="" class="btn btn-info shadow btn-xs sharp"><i class="bi bi-archive"></i>&nbspShow</a>
            <a href="" class="btn btn-success shadow btn-xs sharp"><i class="bi bi-pencil-square"></i>&nbspEdit</a>
            <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="bi bi-trash"></i>&nbspDelete</a>
        </td>
    </tr>
 @endforeach
