<!-- resources/views/profiles/edit.blade.php -->
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

<form  method="POST">
    @csrf
    @method('GET')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $profile->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $profile->email }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control" required>{{ $profile->address }}</textarea>
    </div>
    <div class="form-group">
        <label for="pan_card">PAN Card</label>
        <input type="text" name="pan_card" id="pan_card" class="form-control" value="{{ $profile->pan_card }}" required>
    </div>
    <div class="form-group">
        <label for="aadhar_card">Aadhar Card</label>
        <input type="text" name="aadhar_card" id="aadhar_card" class="form-control" value="{{ $profile->aadhar_card }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
