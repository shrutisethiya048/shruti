@extends('admin.layout.header')
@section('main_section')

<div class="container py-5">
    <h2>Edit Product</h2>

    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" value="{{ $product->price }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control">
            @if($product->image)
                <img src="{{ asset('upload/products/'.$product->image) }}" style="max-width:150px; margin-top:10px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>

@endsection
