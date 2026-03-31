@extends('website.layout.frame')
@section('main_section')
<div class="container py-5">
    <h2 class="mb-4 text-center">🛒 My Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($cartItems->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('website/asset/img/'.$item->product_image) }}"
                                     width="70" alt="">
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>₹ {{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹ {{ $item->price * $item->quantity }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $item->id) }}"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Remove item?')">
                                    Remove
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-muted">Your cart is empty.</p>
    @endif
</div>
@endsection
