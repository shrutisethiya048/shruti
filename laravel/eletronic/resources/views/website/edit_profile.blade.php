@extends('website.layout.frame')
@section('main_section')
<div class="container py-5">
    <h2>Edit Profile</h2>

    <form action="{{ route('profile.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Profile Image</label>
            <input type="file" name="image" class="form-control">
            @if($customer->image)
                <img src="{{ asset('uploads/customers/'.$customer->image) }}" style="max-width:150px;margin-top:10px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>
</div>
@endsection
