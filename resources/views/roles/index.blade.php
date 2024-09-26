@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Roles') }}</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">{{ __('Create New Role') }}</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
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