<!-- resources/views/profiles/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Profiles</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('profiles.create') }}" class="btn btn-primary mb-3">Create Profile</a>

    <div class="card">
        <div class="card-body">
            <table id="profiles-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>PAN Card</th>
                        <th>Aadhar Card</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
        <script>
        $(document).ready(function () {
            $('#profiles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('profiles.datatables') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' },
                    { data: 'pan_card', name: 'pan_card' },
                    { data: 'aadhar_card', name: 'aadhar_card' },
                    { 
                        data: 'id', 
                        name: 'actions', 
                        orderable: false, 
                        searchable: false, 
                        render: function (data, type, row) {
                            var editUrl = "{{ route('profiles.edit', ':id') }}".replace(':id', data);
                            var deleteUrl = "{{ route('profiles.destroy', ':id') }}".replace(':id', data);

                            return '<a href="' + editUrl + '" class="btn btn-primary btn-sm">Edit</a>' +
                                   '<form action="' + deleteUrl + '" method="POST" style="display: inline;">' +
                                       '@csrf' +
                                       '@method('DELETE')' +
                                       '<button type="submit" class="btn btn-danger btn-sm">Delete</button>' +
                                   '</form>';
                        }
                    }
                ]
            });
        });
    </script>
@endpush
