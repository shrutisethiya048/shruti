@extends('admin.layout.header')

@section('main_section')
<div class="container mt-4">

    <h2 class="mb-3">Products</h2>

    <!-- Add Product Button -->
    <a href="#" data-toggle="modal" data-target="#addProduct" class="btn btn-success mb-3">+ Add Product</a>

    <!-- Products Table -->
    <table class="table table-bordered table-striped">
        <tr class="table-dark">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>₹ {{ $product->price }}</td>
            <td>
                @if($product->status == 1)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>

                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Product</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
