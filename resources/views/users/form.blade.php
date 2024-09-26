@extends('layouts.app')

@section('content')
    <h1>{{ isset($user) ? __('Edit User') : __('Create User') }}</h1>
    <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">{{ __('Roles') }}</label>
            <select multiple class="form-control" id="roles" name="roles[]">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ isset($user) && $user->roles->contains($role->id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
