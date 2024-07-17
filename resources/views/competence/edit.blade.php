@extends('layouts.default')

@section('content')
    <div class="container my-5">
        <h2>Edit Competence</h2>
        <form action="{{ route('competence.update', $competence->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group my-5">
                <label for="name">Competence Name</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $competence->name) }}">
                @error('name')
                    <div class="alert alert-danger">
                         {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group my-5">
                <label for="description">Competence Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $competence->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Competence</button>
        </form>
    </div>
@endsection
