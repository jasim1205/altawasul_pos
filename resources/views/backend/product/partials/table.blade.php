<table id="example" class="table table-bordered" style="width:100%">
    <thead class="">
        <tr class="bg-success text-white">
            <th scope="col">{{ __('#SL') }}</th>
            {{-- <th>Company</th> --}}
            {{-- <th>Category</th> --}}
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Stock</th>
            {{-- <th>Product Model</th> --}}
            <th>Cost Code</th>
            <th>OEM</th>
            <th>Origin</th>
            <th>Cross Reference</th>
            <th>Sale Price One</th>
            <th>Sale Price Two</th>
            <th>Description</th>
            {{-- <th>Old Price</th> --}}
            {{-- <th>Cost Unit Price</th> --}}
            <th>QR Code</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $value)
            <tr>
                <td>{{ __(++$loop->index) }}</td>
                {{-- <td>{{ __($value->company?->company_name) }}</td> --}}
                {{-- <td>{{ __($value->category?->category_name) }}</td> --}}
                <td><Strong>{{ __($value->product_name) }}</Strong>
                    <br>
                    model:{{ $value->product_model }}
                    <br>
                    Size: {{ $value->size }}
                </td>
                <td><img src="{{ asset('public/uploads/product/' . $value->product_image) }}"
                        width="50px">
                </td>
                <td>{{ __($value->stock?->quantity ?? 0) }}</td>
                {{-- <td>{{ __($value->product_model) }}</td> --}}
                <td>{{ __($value->cost_code) }}</td>
                <td>{{ __($value->oem) }}</td>
                <td>{{ __($value->origin) }}</td>
                <td>{{ __($value->cross_reference) }}</td>
                {{-- <td>{{ __($value->old_price) }}</td> --}}
                {{-- <td>{{ __($value->cost_unit_price) }}</td> --}}
                <td>{{ __($value->sale_price_one) }}</td>
                <td>{{ __($value->sale_price_two) }}</td>
                <td>
                    {{ $value->description }}

                </td>
                <td>
                    {!! QrCode::size(50)->generate(
                        "Product: {$value->product_name}\n" .
                            "Model: {$value->product_model}\n" .
                            "Category: {$value->category?->category_name}\n" .
                            'Mobile: 0555611560',
                    ) !!}
                </td>

                <td class="white-space-nowrap">
                    <div class="d-flex">
                        <a href="{{ route('product.edit', encryptor('encrypt', $value->id)) }}"
                            class="btn btn-warning text-white" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form
                            action="{{ route('product.destroy', encryptor('encrypt', $value->id)) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border:none"
                                onclick="return confirm('Are you sure to delete?')"
                                title="Delete" class="btn btn-danger ms-2">
                                <span class=""><i class="fa fa-trash"></i></span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center fw-bolder">Product No found</td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $products->withQueryString()->links() }}
