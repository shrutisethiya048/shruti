@extends('admin.layout.header')
@section('main_section')
<div class="container mt-4">
    <h2>Manage Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Products</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->products }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>
                    <a href="{{ route('admin.orders.status', [$order->id, 'Completed']) }}" class="btn btn-sm btn-success">
                        Mark Completed
                    </a>
                    <a href="{{ route('admin.orders.status', [$order->id, 'Cancelled']) }}" class="btn btn-sm btn-danger">
                        Cancel
                    </a>
                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-warning">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No Orders Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
