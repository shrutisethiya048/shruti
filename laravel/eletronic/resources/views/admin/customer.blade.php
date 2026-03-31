@extends('admin.layout.header')
@section('main_section')

<div class="container mt-4">
    <h2>Manage Customers</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Customer Button -->
    <button class="btn btn-primary mb-3" onclick="toggleForm()">
        Add Customer
    </button>

    <!-- Add Customer Form -->
    <div id="customerForm" style="display:none;">
        <form method="POST" action="{{ route('customer.store') }}" class="mb-4">
            @csrf
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>

            <button class="btn btn-success">Save</button>
            <button type="button" class="btn btn-secondary" onclick="toggleForm()">Cancel</button>
        </form>
    </div>

    <!-- Customer Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($customers as $cust)
            <tr>
                <td>{{ $cust->id }}</td>
                <td>{{ $cust->name }}</td>
                <td>{{ $cust->email }}</td>
                <td>{{ $cust->phone }}</td>
                <td>
                    <button class="btn btn-warning btn-sm"
                        onclick="toggleEditForm({{ $cust->id }})">
                        Edit
                    </button>

                    <form action="{{ route('customer.destroy', $cust->id) }}"
                          method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this customer?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- EDIT FORM ROW -->
            <tr id="editForm{{ $cust->id }}" style="display:none;">
                <td colspan="5">
                 <form method="POST" action="{{ route('customer.update', $cust->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                               value="{{ $cust->name }}"
                               class="form-control mb-2" required>

                        <input type="email" name="email"
                               value="{{ $cust->email }}"
                               class="form-control mb-2" required>

                        <input type="text" name="phone"
                               value="{{ $cust->phone }}"
                               class="form-control mb-2" required>

                        <button class="btn btn-success btn-sm">Update</button>
                        <button type="button" class="btn btn-secondary btn-sm"
                            onclick="toggleEditForm({{ $cust->id }})">
                            Cancel
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- JavaScript -->
<script>
function toggleForm() {
    let form = document.getElementById('customerForm');
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}

function toggleEditForm(id) {
    let row = document.getElementById('editForm' + id);
    row.style.display = (row.style.display === 'none') ? 'table-row' : 'none';
}
</script>

@endsection
