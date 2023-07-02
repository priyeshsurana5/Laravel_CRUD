<!-- resources/views/profiles/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Profile Details
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" class="form-control" value="{{ $profile->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" class="form-control" value="{{ $profile->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" id="address" class="form-control" value="{{ $profile->address }}" readonly>
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('storage/' . $profile->image) }}" alt="Profile Image" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
