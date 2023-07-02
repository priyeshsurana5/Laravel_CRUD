@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

            <div class="card-header d-flex justify-content-between">
                <span>Profiles</span>
                <a href="{{ route('profiles.create') }}" class="btn btn-primary ml-auto">Add Profile</a>
            </div>
            <div class="card-body">
                <table id="profilesTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#profilesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url: '{{url('datatables')}}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' },
                    {data: "id", className: 'text-center',render: function (data, type, row){
                      
                      return '<a class="btn btn-primary" href="{{URL::to('edit')}}/'+data+'" >Edit</a>&nbsp;&nbsp;<a class="btn btn-primary" onclick="deletedata('+data+')">Delete</a>';
                      
                    }},
                   
                ],
            });
        });
               function deletedata(val) {
        if (confirm('Are you sure you want to delete this profile?')) {
            $.ajax({
                url: "deletedata",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "val": val
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted Success',
                        text: response.success
                    }).then(() => {
                        $('#profilesTable').DataTable().ajax.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error deleting profile. Please try again.'
                    });
                }
            });
        }
    }
    </script>
@endsection
