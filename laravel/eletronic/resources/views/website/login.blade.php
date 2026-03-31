<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-body">

                    <h3 class="text-center mb-4">Login</h3>

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

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ url('/login_auth') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="Enter your email"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="Enter your password"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>

                        <p class="text-center mt-3">
                            Don't have an account?
                            <a href="{{ url('/signup') }}">Sign Up</a>
                        </p>
                        <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>