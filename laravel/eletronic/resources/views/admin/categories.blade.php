@extends('admin.layout.header')

@section('main_section')
<div class="container mt-4">

    <h3>Manage Categories</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ADD CATEGORY BUTTON -->
    <button class="btn btn-success mb-3"
            data-toggle="modal"
            data-target="#addCategoryModal">
        + Add Category
    </button>

    <!-- CATEGORIES TABLE -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->description }}</td>

                <!-- STATUS -->
                <td>
                    <a href="{{ route('admin.categories.status', $cat->id) }}"
                       class="btn btn-sm {{ $cat->status ? 'btn-success' : 'btn-danger' }}">
                        {{ $cat->status ? 'Active' : 'Inactive' }}
                    </a>
                </td>

                <!-- IMAGE -->
                <td>
                    @if($cat->image)
                        <img src="{{ asset('upload/categories/'.$cat->image) }}" width="60">
                    @endif
                </td>

                <!-- ACTIONS -->
                <td>
                    <!-- EDIT BUTTON -->
                    <button class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#editCategory{{ $cat->id }}">
                        Edit
                    </button>
                    <!-- DELETE -->
                    <a href="{{ route('admin.categories.delete', $cat->id) }}"
                       onclick="return confirm('Delete this category?')"
                       class="btn btn-danger btn-sm">
                        Delete
                    </a>
                </td>
            </tr>

            <!-- EDIT MODAL -->
            <div class="modal fade" id="editCategory{{ $cat->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="POST"
                              action="{{ url('admin/categories/'.$cat->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <input type="text" name="name"
                                       class="form-control mb-2"
                                       value="{{ $cat->name }}" required>

                                <textarea name="description"
                                          class="form-control mb-2">{{ $cat->description }}</textarea>

                                <select name="status" class="form-control mb-2">
                                    <option value="1" {{ $cat->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$cat->status ? 'selected' : '' }}>Inactive</option>
                                </select>

                                <input type="file" name="image" class="form-control mb-2">
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                    Cancel
                                </button>
                                <button class="btn btn-primary">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST"
                  action="{{ url('admin/categories') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="text" name="name"
                           class="form-control mb-2"
                           placeholder="Category Name" required>

                    <textarea name="description"
                              class="form-control mb-2"
                              placeholder="Description"></textarea>

                    <select name="status" class="form-control mb-2">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                    <input type="file" name="image" class="form-control mb-2">
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-primary">Save</button>
                </div>
</form>
        </div>
    </div>
</div>
@endsection
