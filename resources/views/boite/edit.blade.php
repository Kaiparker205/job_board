@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title m-0">Edit Boite</h1>

                        <!-- Delete Form -->
                        <form action="{{ route('boite.destroy', ['boite' => $boite->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>

                    <div class="card-body">
                        <form action="{{ route('boite.update', $boite->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('content', $boite->name) }}" required>
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required>{{ old('content', $boite->content) }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('boite.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
