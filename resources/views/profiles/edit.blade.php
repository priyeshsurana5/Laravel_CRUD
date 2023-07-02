<!-- edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form id="profile-form" action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name <span class="badge badge-danger">Required</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $profile->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="badge badge-danger">Required</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $profile->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address <span class="badge badge-danger">Required</span></label>
                        <textarea class="form-control" name="address" id="address" required>{{ old('address', $profile->address) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="pan_card">PAN Card <span class="badge badge-danger">Required</span></label>
                        <input type="text" class="form-control" name="pan_card" id="pan_card" value="{{ old('pan_card', $profile->pan_card) }}">
                    </div>

                    <div class="form-group">
                        <label for="aadhar_card">Aadhar Card <span class="badge badge-danger">Required</span></label>
                        <input type="text" class="form-control" name="aadhar_card" id="aadhar_card" value="{{ old('aadhar_card', $profile->aadhar_card) }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <div class="mb-3">
                            @if ($profile->image)
                                <img src="{{ asset('images/' . $profile->image) }}" alt="Profile Image" class="rounded-circle" style="width: 100px; height: 100px;">
                            @endif
                        </div>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
<br>
                    <div class="d-flex justify-content-between">
                        <button id="back-btn" type="button" class="btn btn-secondary">Back</button>
                        <button id="submit-btn" type="button" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#back-btn').click(function() {
                // Redirect back to the previous page
                window.history.back();
            });

            $('#submit-btn').click(function(e) {
                e.preventDefault();

                // Get the Aadhar card number value
                var aadharNumber = $('#aadhar_card').val();
                var panNumber = $('#pan_card').val();
                
                // Perform the validation
                var isValidAadhar = validateAadharCard(aadharNumber);
                var isValidPan = validatePanCard(panNumber);

                if (!isValidAadhar) {
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Aadhar Card',
                        text: 'Please enter a valid 12-digit Aadhar Card number.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else if (!isValidPan) {
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid PAN Card',
                        text: 'Please enter a valid PAN Card number.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // No errors, submit the form
                    $('#profile-form').submit();
                }
            });

            // Function to validate Aadhar card number
            function validateAadharCard(aadharNumber) {
                var aadharRegex = /^\d{12}$/;
                return aadharRegex.test(aadharNumber);
            }
            
            // Function to validate PAN card number
            function validatePanCard(panNumber) {
                var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
                return panRegex.test(panNumber);
            }
        });
    </script>
@endsection
