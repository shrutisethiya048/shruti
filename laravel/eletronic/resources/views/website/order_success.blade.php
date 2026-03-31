@extends('website.layout.frame')
@section('main_section')

<div class="container py-5 text-center">

<h1 class="text-success">Order Placed Successfully 🎉</h1>

<p class="mt-3">
Thank you for your order. Your order has been received.
</p>

<a href="{{ url('/') }}" class="btn btn-primary mt-4">
Continue Shopping
</a>

</div>
@endsection