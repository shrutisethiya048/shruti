@extends('website.layout.frame')
@section('main_section')

<div class="container mt-5">

<h2>Reset Password</h2>

<form method="POST" action="/update-password">
@csrf

<div class="form-group">
<label>New Password</label>
<input type="password" name="password" class="form-control">
</div>

<br>

<button type="submit" class="btn btn-primary">
Update Password
</button>

</form>

</div>

@endsection