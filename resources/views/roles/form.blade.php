@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($role) ? __('Edit Role') : __('Create Role') }}</h1>
    <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
        @csrf
        @if(isset($role))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection