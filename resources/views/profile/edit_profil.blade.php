@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>Edit Cv</h1>
        <form action="{{ route('cv.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cv">Upload New CV:</label>
                <input type="file" class="form-control" id="cv" name="cv_path">
                @error('cv_path')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="profileImage">Upload New Profile Image:</label>
                <input type="file" class="form-control" id="profileImage" name="profil_path">
                @error('profil_path')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- Other profile fields -->
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
