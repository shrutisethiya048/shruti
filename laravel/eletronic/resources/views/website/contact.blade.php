@extends('website.layout.frame')
@section('main_section')

<!-- Contact Start -->
<div class="container-fluid contact py-5">
<div class="container py-5">
<div class="p-5 bg-light rounded">

<div class="row g-4">

<div class="col-12">
<div class="text-center mx-auto wow fadeInUp" style="max-width: 900px;">
<h4 class="text-primary border-bottom border-primary border-2 d-inline-block pb-2">Get in touch</h4>
<p class="mb-5 fs-5 text-dark">We are here for you! how can we help, We are here for you!</p>
</div>
</div>

<div class="col-lg-7">

<h5 class="text-primary">Let’s Connect</h5>
<h1 class="display-5 mb-4">Send Your Message</h1>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form action="{{ route('website.contact.submit') }}" method="POST">
@csrf

<div class="row g-4">

<div class="col-lg-12 col-xl-6">
<div class="form-floating">
<input type="text" name="name" class="form-control" placeholder="Your Name" required>
<label>Name</label>
</div>
</div>

<div class="col-lg-12 col-xl-6">
<div class="form-floating">
<input type="email" name="email" class="form-control" placeholder="Your Email" required>
<label>Email</label>
</div>
</div>
<div class="col-lg-12 col-xl-6">
<div class="form-floating">
<input type="text" name="phone" class="form-control" placeholder="Phone" required>
<label>Phone</label>
</div>
</div>
<div class="col-12">
<div class="form-floating">
<textarea name="message" class="form-control" placeholder="Leave a message here" style="height:160px"></textarea>
<label>Message</label>
</div>
</div>

<div class="col-12">
<button type="submit" class="btn btn-primary w-100 py-3">
Send Message
</button>
</div>

</div>
</form>
</div>
<!-- Contact Section End -->
@endsection
