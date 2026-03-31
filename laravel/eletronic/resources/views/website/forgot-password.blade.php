@extends('website.layout.frame')
@section('main_section')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h3 class="text-center mb-4">Forgot Password</h3>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('forgot-password') }}">
                @csrf

                <div class="form-group mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn btn-primary w-70 mb-4">
                           submit
                </button>
            </form>

        </div>
    </div>
</div>

@endsection