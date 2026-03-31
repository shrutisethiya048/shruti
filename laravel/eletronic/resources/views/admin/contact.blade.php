@extends('admin.layout.header')
@section('main_section')

<div class="container mt-4">
    <h2>Manage Contacts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ADD BUTTON -->
    <button class="btn btn-primary mb-3" onclick="toggleAddForm()">Add Contact</button>

    <!-- ADD FORM -->
    <div id="addForm" style="display:none;">
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf

            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
            <textarea name="message" class="form-control mb-2" placeholder="Message"></textarea>

            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-secondary" onclick="toggleAddForm()">Cancel</button>
        </form>
    </div>

    <!-- TABLE -->
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Action</th>
        </tr>

        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->phone }}</td>
            <td>{{ $contact->message }}</td>
            <td>
                <button class="btn btn-warning btn-sm"
                        onclick="toggleEditForm({{ $contact->id }})">Edit</button>

                <form action="{{ route('contact.destroy', $contact->id) }}"
                      method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>

        <!-- EDIT FORM -->
        <tr id="editForm{{ $contact->id }}" style="display:none;">
            <td colspan="6">
                <form method="POST" action="{{ route('contact.update', $contact->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name"
                           value="{{ $contact->name }}"
                           class="form-control mb-2" required>

                    <input type="email" name="email"
                           value="{{ $contact->email }}"
                           class="form-control mb-2" required>

                    <input type="text" name="phone"
                           value="{{ $contact->phone }}"
                           class="form-control mb-2" required>

                    <textarea name="message"
                              class="form-control mb-2">{{ $contact->message }}</textarea>

                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                    <button type="button" class="btn btn-secondary btn-sm"
                            onclick="toggleEditForm({{ $contact->id }})">Cancel</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<script>
function toggleAddForm() {
    let f = document.getElementById('addForm');
    f.style.display = f.style.display === 'none' ? 'block' : 'none';
}

function toggleEditForm(id) {
    let f = document.getElementById('editForm' + id);
    f.style.display = f.style.display === 'none' ? 'table-row' : 'none';
}
</script>

@endsection
