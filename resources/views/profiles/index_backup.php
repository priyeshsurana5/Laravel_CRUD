<h1>Profiles</h1>
<a href="{{ route('profiles.create') }}">Create New Profile</a>

@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>PAN Card</th>
            <th>Aadhar Card</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profiles as $profile)
            <tr>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->email }}</td>
                <td>{{ $profile->address }}</td>
                <td>{{ $profile->pan_card }}</td>
                <td>{{ $profile->aadhar_card }}</td>
                <td>
                    <a href="{{ route('profiles.show', $profile->id) }}">View</a>
                    <a href="{{ route('profiles.edit', $profile->id) }}">Edit</a>
                    <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<h1>Profiles</h1>
<a href="{{ route('profiles.create') }}">Create New Profile</a>

@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>PAN Card</th>
            <th>Aadhar Card</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profiles as $profile)
            <tr>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->email }}</td>
                <td>{{ $profile->address }}</td>
                <td>{{ $profile->pan_card }}</td>
                <td>{{ $profile->aadhar_card }}</td>
                <td>
                    <a href="{{ route('profiles.show', $profile->id) }}">View</a>
                    <a href="{{ route('profiles.edit', $profile->id) }}">Edit</a>
                    <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
