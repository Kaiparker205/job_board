@extends('layouts.default')

@section('content')
    <div class="container my-5">
        <h2>Edit Diploma</h2>
        <form action="{{ route('diplome.update', $diplome->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group my-5">
                <label for="type">Diploma Type</label>
                <input type="text" name="type" id="type" class="form-control" required value="{{ old('place',$diplome->type) }}">
                @error('type')
                    <div class="alert alert-danger">
                         {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group my-5">
                <label for="place">Diploma Place</label>
                <input type="text" name="place" id="place" class="form-control" required value="{{ old('place',$diplome->place) }}">
                @error('place')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Diploma</button>
        </form>
    </div>
@endsection
