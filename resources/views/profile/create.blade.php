
@extends('layouts.default')

@section('content')
<div class="container my-5">
    <h1>Create Profile</h1>
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="cv">Upload CV:</label>
            <input type="file" class="form-control" id="cv" name="cv_path" required>
            @error('cv_path')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="profileImage">Upload Profile Image:</label>
            <input type="file" class="form-control" id="profileImage" name="profil_path" required>
            @error('profil_path')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Create Profile</button>
    </form>
</div>
@endsection
