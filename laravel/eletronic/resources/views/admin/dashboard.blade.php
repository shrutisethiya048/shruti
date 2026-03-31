@extends('admin.layout.header')
@section('main_section')
<!-- Sale & Revenue Boxes -->
<div class="row g-4">
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-chart-line fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Today Sale</p>
                <h6 class="mb-0">$1234</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-chart-bar fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total Sale</p>
                <h6 class="mb-0">$5678</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-chart-area fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Today Revenue</p>
                <h6 class="mb-0">$910</h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-pie-chart fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">Total Revenue</p>
                <h6 class="mb-0">$11234</h6>
            </div>
        </div>
    </div>
</div>
<!-- Charts -->
<div class="row g-4 mt-4">
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Worldwide Sales</h6>
                <a href="#">Show All</a>
            </div>
            <canvas id="worldwide-sales"></canvas>
        </div>
    </div>
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Sales & Revenue</h6>
                <a href="#">Show All</a>
            </div>
            <canvas id="sales-revenue"></canvas>
        </div>
    </div>
</div>

<!-- Recent Sales Table -->
<div class="bg-light text-center rounded p-4 mt-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0">Recent Sales</h6>
        <a href="#">Show All</a>
    </div>
    <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-0">
            <thead>
                <tr class="text-dark">
                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                    <th scope="col">Date</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input class="form-check-input" type="checkbox"></td>
                    <td>20 Dec 2025</td>
                    <td>INV-001</td>
                    <td>John Doe</td>
                    <td>$120</td>
                    <td>Paid</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox"></td>
                    <td>19 Dec 2025</td>
                    <td>INV-002</td>
                    <td>Jane Smith</td>
                    <td>$300</td>
                    <td>Pending</td>
                    <td><button class="btn btn-primary btn-sm">Detail</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Messages, Calendar, To-Do -->
<div class="row g-4 mt-4">
    <!-- Messages -->
    <div class="col-sm-12 col-xl-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Messages</h6>
                <a href="#">Show All</a>
            </div>
            <div class="d-flex align-items-center mb-3">
                <img class="rounded-circle" src="{{ asset('admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="ms-3">
                    <h6 class="mb-0">John Doe</h6>
                    <small>15 min ago</small>
                    <p class="mb-0">Short message goes here...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div class="col-sm-12 col-xl-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Calendar</h6>
                <a href="#">Show All</a>
            </div>
            <div id="calendar"></div>
        </div>
    </div>

    <!-- To-Do List -->
    <div class="col-sm-12 col-xl-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">To-Do List</h6>
                <a href="#">Show All</a>
            </div>
            <div>
                <input class="form-control mb-2" type="text" placeholder="Enter task">
                <div>
                    <input class="form-check-input me-1" type="checkbox">
                    <label class="form-check-label">Short task goes here...</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('worldwide-sales').getContext('2d');
    const worldwideSalesChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May'],
            datasets: [{
                label: 'Sales',
                data: [12,19,3,5,2],
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        }
    });

    const ctx2 = document.getElementById('sales-revenue').getContext('2d');
    const salesRevenueChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May'],
            datasets: [{
                label: 'Revenue',
                data: [150,200,120,170,250],
                borderColor: 'rgba(255,99,132,1)',
                backgroundColor: 'rgba(255,99,132,0.2)',
                fill: true
            }]
        }
    });
</script>

@endsection
