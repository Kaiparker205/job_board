@extends('layouts.default')

@section('content')
    <div class="container my-5">
        <h1>Create Contact</h1>
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf
            <div class="form-group my-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Create</button>
        </form>
    </div>
@endsection
