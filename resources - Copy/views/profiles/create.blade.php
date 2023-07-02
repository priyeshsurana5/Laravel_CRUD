<!-- resources/views/profiles/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create Profile</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-4">
            <div id="imagePreview" class="text-center">
                <img id="previewImage" src="{{ asset('images/avatar-placeholder.png') }}" class="img-thumbnail" alt="Profile Image">
            </div>
        </div>
        <div class="col-md-8">
            <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data" id="createProfileForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Profile Image (PNG/JPG)</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="pan_card" class="form-label">PAN Card</label>
                    <input type="text" name="pan_card" id="pan_card" class="form-control" required>
                    <small id="panError" class="text-danger"></small>
                </div>
                <div class="mb-3">
                    <label for="aadhar_card" class="form-label">Aadhar Card</label>
                    <input type="text" name="aadhar_card" id="aadhar_card" class="form-control" required>
                    <small id="aadharError" class="text-danger"></small>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <script>
        // Show image preview
        document.getElementById('image').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }

            reader.readAsDataURL(file);
        });

        // Custom validation for PAN card
        document.getElementById('pan_card').addEventListener('blur', function() {
            var panCardInput = this.value;
            var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

            if (!panRegex.test(panCardInput)) {
                document.getElementById('panError').textContent = 'Invalid PAN Card format';
            } else {
                document.getElementById('panError').textContent = '';
            }
        });

        // Custom validation for Aadhar card
        document.getElementById('aadhar_card').addEventListener('blur', function() {
            var aadharCardInput = this.value;
            var aadharRegex = /^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/;

            if (!aadharRegex.test(aadharCardInput)) {
                document.getElementById('aadharError').textContent = 'Invalid Aadhar Card format';
            } else {
                document.getElementById('aadharError').textContent = '';
            }
        });

        // Form submission
        document.getElementById('createProfileForm').addEventListener('submit', function(event) {
            var panCardInput = document.getElementById('pan_card').value;
            var aadharCardInput = document.getElementById('aadhar_card').value;

            var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            var aadharRegex = /^[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}$/;

            if (!panRegex.test(panCardInput) || !aadharRegex.test(aadharCardInput)) {
                event.preventDefault(); // Prevent form submission
                alert('Please fix the validation errors');
            }
        });
    </script>
@endsection
