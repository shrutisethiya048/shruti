<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DASHMIN - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('admin/img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries CSS -->
    <link href="{{ asset('admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Bootstrap 4 CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template CSS -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>

<body>
<div class="container-xxl position-relative bg-white d-flex p-0">

    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">
                    <i class="fa fa-hashtag me-2"></i>DASHMIN
                </h3>
            </a>

            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle"
                         src="{{ asset('admin/img/user.jpg') }}"
                         style="width:40px;height:40px;">
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">ADMIN PANEL</h6>
                    <span>Admin</span>
                </div>
            </div>

            <div class="navbar-nav w-100">
                <a href="{{ url('/admin/dashboard') }}" class="nav-item nav-link">
                    <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                </a>

                <a href="{{ url('/admin/categories') }}" class="nav-item nav-link">
                    <i class="fa fa-tags me-2"></i>Categories
                </a>

                <a href="{{ url('/admin/products') }}" class="nav-item nav-link">
                    <i class="fa fa-box me-2"></i>Products
                </a>
                <a href="{{ url('/admin/orders') }}" class="nav-item nav-link">
                 <i class="fa fa-shopping-cart me-2"></i> Orders
                   </a>
                   <a href="{{ url('/admin/customer') }}" class="nav-item nav-link">
                 <i class="fa fa-user me-2"></i> Customers 
                   </a>
                   <a href="{{ url('/admin/contact') }}" class="nav-item nav-link">
                 <i class="fa fa-address-book me-2"></i> Contact
                   </a>
                </div>
                
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">

        <!-- Navbar -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
        </nav>
        <!-- Main Section -->
        <div class="container-fluid pt-4 px-4">
            @yield('main_section')
        </div>

    </div>
    <!-- Content End -->
</div>

<!-- ================= JS ================= -->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Bootstrap 4 Bundle (MOST IMPORTANT) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Other Libraries -->
<script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></cript>
<script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template JS -->
<script src="{{ asset('admin/js/main.js') }}"></script>

</body>
</html>
