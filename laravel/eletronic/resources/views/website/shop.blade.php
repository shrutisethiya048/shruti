@extends('website.layout.frame')
@section('main_section')
<!-- Full-width Product Banner Start -->
<div class="container-fluid py-5">
    <div class="row g-0">
        <div class="col-12 wow fadeIn" data-wow-delay="0.2s">
            <a href="#">
                <div class="text-center position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center" style="background: rgba(242, 139, 0, 0.5);">
                       <h4 class="banner-sale-text text-white fw-bold mb-3">SALE</h2>
                        <h4 class="banner-off-text text-white mb-4">Get UP To 50% Off</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Full-width Product Banner End -->

<!-- Services Start -->
<div class="container-fluid px-0 mb-5">
    <div class="row g-0 text-center">
        <div class="col-6 col-md-4 col-lg-2 p-4 wow fadeInUp">
            <i class="fa fa-sync-alt fa-2x text-primary"></i>
            <h6 class="mt-2">Free Return</h6>
            <p>30 days money back guarantee!</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 p-4 wow fadeInUp">
            <i class="fab fa-telegram-plane fa-2x text-primary"></i>
            <h6 class="mt-2">Free Shipping</h6>
            <p>Free shipping on all order</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 p-4 wow fadeInUp">
            <i class="fas fa-life-ring fa-2x text-primary"></i>
            <h6 class="mt-2">Support 24/7</h6>
            <p>We support online 24 hrs a day</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 p-4 wow fadeInUp">
            <i class="fas fa-credit-card fa-2x text-primary"></i>
            <h6 class="mt-2">Receive Gift Card</h6>
            <p>Receive gift all over order $50</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 p-4 wow fadeInUp">
            <i class="fas fa-lock fa-2x text-primary"></i>
            <h6 class="mt-2">Secure Payment</h6>
            <p>We Value Your Security</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 p-4 wow fadeInUp">
            <i class="fas fa-blog fa-2x text-primary"></i>
            <h6 class="mt-2">Online Service</h6>
            <p>Free return products in 30 days</p>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Products Grid Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar Start -->
            <div class="col-lg-3">
                <h5 class="mb-3">Products Categories</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">Accessories <span>(3)</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Electronics & Computer <span>(5)</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Laptops & Desktops <span>(2)</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Mobiles & Tablets <span>(8)</span></li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">SmartPhone & Smart TV <span>(5)</span></li>
                </ul>
                <h5 class="mb-3">Price</h5>
                <input type="range" class="form-range mb-4">
            </div>
            <!-- Sidebar End -->

            <!-- Products Grid Start -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @php
                        $products = [
                            ['name'=>'Apple iPad Mini G2356', 'category'=>'SmartPhone', 'price_old'=>'1,25,000', 'price_new'=>'1,05,000', 'img'=>'product-1.png'],
                            ['name'=>'Canon Camera X100', 'category'=>'Camera', 'price_old'=>'1,50,000', 'price_new'=>'1,20,000', 'img'=>'product-2.png'],
                            ['name'=>'Sigma Lens 24-70', 'category'=>'Camera Lens', 'price_old'=>'90,000', 'price_new'=>'72,000', 'img'=>'product-3.png'],
                            ['name'=>'Apple Watch Series 6', 'category'=>'Smart Watch', 'price_old'=>'60,000', 'price_new'=>'48,000', 'img'=>'product-4.png'],
                            ['name'=>'Samsung Galaxy S23', 'category'=>'SmartPhone', 'price_old'=>'1,20,000', 'price_new'=>'99,000', 'img'=>'product-5.png'],
                            ['name'=>'Dell XPS 13', 'category'=>'Laptop', 'price_old'=>'1,80,000', 'price_new'=>'1,50,000', 'img'=>'product-6.png'],
                            ['name'=>'MacBook Air M2', 'category'=>'Laptop', 'price_old'=>'1,50,000', 'price_new'=>'1,20,000', 'img'=>'product-7.png'],
                            ['name'=>'iPhone 14 Pro', 'category'=>'SmartPhone', 'price_old'=>'1,30,000', 'price_new'=>'1,10,000', 'img'=>'product-8.png'],
                            ['name'=>'GoPro Hero 11', 'category'=>'Camera', 'price_old'=>'70,000', 'price_new'=>'55,000', 'img'=>'product-9.png'],
                            ['name'=>'Sony Headphones', 'category'=>'Audio', 'price_old'=>'25,000', 'price_new'=>'20,000', 'img'=>'product-10.png'],
                            ['name'=>'iMac 24"', 'category'=>'Desktop', 'price_old'=>'2,00,000', 'price_new'=>'1,75,000', 'img'=>'product-11.png'],
                            ['name'=>'Apple iPad Pro', 'category'=>'Tablet', 'price_old'=>'1,10,000', 'price_new'=>'95,000', 'img'=>'product-12.png'],
                        ];
                    @endphp

                    @foreach($products as $product)
                    <div class="col-md-4 wow fadeInUp">
                        <div class="card border-0">
                            <div class="position-relative">
                                <img src="{{ asset('website/asset/img/'.$product['img']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">New</span>
                            </div>
                            <div class="card-body text-center">
                                <h6 class="text-muted">{{ $product['category'] }}</h6>
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                <p class="card-text">
                                    <span class="text-decoration-line-through text-muted">Rs. {{ $product['price_old'] }}</span>
                                    <span class="text-primary fw-bold">Rs. {{ $product['price_new'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Products Grid End -->
        </div>
    </div>
</div>
<!-- Products Grid End -->

@endsection
