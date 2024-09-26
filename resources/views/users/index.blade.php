@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="d-none d-md-table-header-group">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="d-flex flex-column d-md-table-row">
                        <td class="d-block d-md-table-cell"><strong class="d-md-none">ID:</strong> {{ $user->id }}</td>
                        <td class="d-block d-md-table-cell"><strong class="d-md-none">Name:</strong> {{ $user->name }}</td>
                        <td class="d-block d-md-table-cell"><strong class="d-md-none">Email:</strong> {{ $user->email }}</td>
                        <td class="d-block d-md-table-cell"><strong class="d-md-none">Roles:</strong> {{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td class="d-block d-md-table-cell">
                            <div class="btn-group mt-2" role="group">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection