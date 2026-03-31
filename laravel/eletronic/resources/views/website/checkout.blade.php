@extends('website.layout.frame')
@section('main_section')

<div class="container-fluid bg-light overflow-hidden py-5">
<div class="container py-5">

<h1 class="mb-4">Billing Details</h1>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form action="{{ route('place.order') }}" method="POST">
@csrf

<div class="row g-5">

<!-- Billing Form -->
<div class="col-md-6">

<div class="row">
<div class="col-md-6">
<label class="form-label">First Name</label>
<input type="text" name="first_name" class="form-control" required>
</div>

<div class="col-md-6">
<label class="form-label">Last Name</label>
<input type="text" name="last_name" class="form-control" required>
</div>
</div>

<div class="mt-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mt-3">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control" required>
</div>

<div class="mt-3">
<label>Address</label>
<input type="text" name="address" class="form-control" required>
</div>

<div class="mt-3">
<label>City</label>
<input type="text" name="city" class="form-control" required>
</div>

<div class="mt-3">
<label>Country</label>
<input type="text" name="country" class="form-control" required>
</div>

<div class="mt-3">
<label>Pincode</label>
<input type="text" name="pincode" class="form-control" required>
</div>

</div>


<!-- Order Summary -->
<div class="col-md-6">

<div class="table-responsive">
<table class="table">

<thead>
<tr>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>
</thead>

<tbody>

@php
$subtotal = 0;
@endphp


@if($cartItems->count() > 0)

@foreach($cartItems as $item)

@php
$total = $item->price * $item->quantity;
$subtotal += $total;
@endphp

<tr>
<td>{{ $item->product_name }}</td>
<td>${{ $item->price }}</td>
<td>{{ $item->quantity }}</td>
<td>${{ $total }}</td>
</tr>

@endforeach

@else

<tr>
<td colspan="4" class="text-center">
Your cart is empty
</td>
</tr>

@endif

<tr>
<td colspan="3"><strong>Total</strong></td>
<td><strong>${{ $subtotal }}</strong></td>
</tr>

</tbody>

</table>
</div>

<button type="submit" class="btn btn-primary w-100">
Place Order
</button>

</div>

</div>

</form>

</div>
</div>

@endsection