{{-- edit.blade.php --}}
@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>Edit Contact</h1>
        <form method="POST" action="{{ route('contact.update', $contact) }}">
            @csrf
            @method('PUT')
            <div class="form-group my-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required
                    value="{{ old('email', $contact->email) }}">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required
                    value="{{ old('address', $contact->address) }}">
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $contact->phone) }}" required>
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
@endsection
