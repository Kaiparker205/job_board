@extends('admin.layout.default')
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Send Rapport </h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.send')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">subject</label>
                                <input type="text" class="form-control" id="name" name="subject" value="{{ old('subject') }}" required>
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
