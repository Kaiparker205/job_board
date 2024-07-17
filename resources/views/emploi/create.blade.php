{{-- resources/views/emplois/create.blade.php --}}

@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <h2>Create New Emploi</h2>
    <form method="POST" action="{{ route('emploi.store') }}">
        @csrf
        <div class="form-group my-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group my-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group my-3">
            <label for="salary">Salary</label>
            <input type="number" class="form-control" id="salary" name="salary" required>
        </div>
        <div class="form-group my-3">
            <label for="salary">Delay</label>
            <input type="number" class="form-control" id="salary" name="delay" required>
            @error('delay')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100 my-5">Submit</button>
    </form>
</div>
@endsection
