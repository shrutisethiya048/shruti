<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Electro - Electronics Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('website/asset/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('website/asset/css/style.css') }}" rel="stylesheet">

    <!-- 🔧 FIX CSS -->
    <style>
        /* ===== TOPBAR FIX ===== */
        .topbar {
            height: 45px;
        }
        .topbar .row {
            height: 45px;
            align-items: center;
        }
        .topbar-phone {
            font-size: 14px;
            font-weight: 600;
            color: #000;
            text-decoration: none;
            white-space: nowrap;
            line-height: 1;
        }
        .topbar-phone:hover {
            color: #fd7e14;
        }
    </style>
</head>

<body>

<!-- ================= TOPBAR START ================= -->
<div class="container-fluid border-bottom d-none d-lg-block px-5 topbar">
    <div class="row gx-0">

        <!-- Left -->
        <div class="col-lg-4">
            <div class="d-flex align-items-center h-100">
                <a href="#" class="text-muted me-2">Help</a> /
                <a href="#" class="text-muted mx-2">Support</a> /
                <a href="#" class="text-muted ms-2">Contact</a>
                @if(session()->has('sid'))
                    <a class="nav-icon position-relative text-decoration-none" href="userprofile">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        Hi .. {{session('sname')}}
                    </a>
                    @endif
            </div>
        </div>

        <!-- Center (PHONE - NO BUTTON HERE) -->
        <div class="col-lg-4 d-flex justify-content-center align-items-center gap-2">
            <i class="fa fa-phone-alt text-primary"></i>
            <span class="fw-semibold text-dark">Call Us:</span>
            <a href="tel:+01234567890" class="topbar-phone">
                +0123 456 7890
            </a>
        </div>

        <!-- Right -->
        <div class="col-lg-4 text-end">
            <div class="d-flex justify-content-end align-items-center h-100">

                <div class="dropdown me-3">
                    <a href="#" class="dropdown-toggle text-muted" data-bs-toggle="dropdown">
                        <small>USD</small>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Euro</a>
                        <a class="dropdown-item" href="#">Dollar</a>
                    </div>
                </div>

                <div class="dropdown me-3">
                    <a href="#" class="dropdown-toggle text-muted" data-bs-toggle="dropdown">
                        <small>English</small>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Hindi</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted" data-bs-toggle="dropdown">
                        <small><i class="fa fa-home me-1"></i> My Dashboard</small>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Login</a>
                        <a class="dropdown-item" href="#">My Cart</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- ================= TOPBAR END ================= -->

<!-- ================= NAVBAR START ================= -->
<div class="container-fluid bg-primary px-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">

        <a class="navbar-brand d-lg-none text-white fw-bold" href="#">Electro</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-white"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

            <!-- LEFT LINKS -->
            <div class="navbar-nav ms-auto py-0 align-items-lg-center">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ url('/shop') }}" class="nav-item nav-link">Shop</a>
                <a href="{{ url('/cart') }}" class="nav-item nav-link">Cart</a>
                <a href="{{ url('/checkout') }}" class="nav-item nav-link">Checkout</a>
                <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>

                @if(session()->has('sid'))
                    <a href="{{ url('userlogout') }}" class="nav-item nav-link">Logout</a>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-light ms-lg-3 mt-2 mt-lg-0">
                        Login
                    </a>
                @endif
            </div>

            <!-- RIGHT ICONS -->
            <div class="d-flex align-items-center ms-lg-4 mt-3 mt-lg-0">

                <!-- Search -->
                <a class="nav-icon text-decoration-none me-3" href="#">
                    <i class="fa fa-fw fa-search text-dark"></i>
                </a>

                <!-- Cart -->
                <a class="nav-icon position-relative text-decoration-none me-3"
                   href="{{ url('/cart') }}">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>

                <!-- User -->
                @if(session()->has('sid'))
                    <a class="nav-icon text-decoration-none" href="{{ url('userprofile') }}">
                        <i class="fa fa-fw fa-user text-dark"></i>
                        <span class="ms-1 text-dark">Hi {{ session('sname') }}</span>
                    </a>
                @endif

                <!-- Call Button -->
                <a href="tel:+01234567890"
                   class="btn btn-secondary rounded-pill py-2 px-4 ms-lg-3">
                    <i class="fa fa-mobile-alt me-2"></i> +0123 456 7890
                </a>

            </div>
        </div>
    </nav>
</div>
<!-- ================= NAVBAR END ================= -->
<!-- Bootstrap JS -->
<script src="{{ asset('website/asset/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
