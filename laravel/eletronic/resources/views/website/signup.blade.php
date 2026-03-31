@extends('website.layout.frame')
@section('main_section')
    <!-- Start Content Page -->
    <div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Signup Us</h1>
            
        </div>
    </div>
    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <form action="{{ url('signup') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Phone</label>
        <input type="number" name="phone" class="form-control" required>
    </div>
    <div class="form-group mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>
    <button type="submit" class="btn btn-success">Signup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->
@endsection
