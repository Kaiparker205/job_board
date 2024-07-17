{{-- resources/views/emplois/create.blade.php --}}

@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <h2>Create New Employeur</h2>
            <form method="POST" action="{{ route('employeur.store') }}">
                @csrf
                <div class="form-group my-3">
                    <label for="title">name</label>
                    <input type="text" class="form-control" id="title" name="name" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 my-5">Submit</button>
            </form>
    </div>
@endsection
