@extends('website.layout.frame')
@section('main_section')
    <section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>User Profile</h1>
                    <h1>Hi ... {{session('sname')}}</h1>
                    <hr>
                    <h3>Id : {{$customer->id}}</h3>
                    <h3>Name : {{$customer->name}}</h3>
                    <h3>Email : {{$customer->email}}</h3>
                    <a href="{{ route('profile.edit', $customer->id) }}" class="btn btn-primary">Edit Profile</a>
                </div>
                <div class="col-md-4">
                <img src="{{ asset('uploads/customers/testimonial-1.jpg') }}" alt="Customer Image">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->

@endsection
