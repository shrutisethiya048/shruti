@extends('website.layout.frame')
@section('main_section')

<div class="container mt-5">
<h2>OTP Verification</h2>

@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

<form method="POST" action="/verify-otp">
@csrf

<div class="form-group">
<label>Enter OTP</label>
<input type="text" name="otp" class="form-control" placeholder="Enter OTP">
</div>

<br>

<button type="submit" class="btn btn-primary">
Verify OTP
</button>

</form>

</div>

@endsection