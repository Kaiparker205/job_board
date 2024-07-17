{{-- resources/views/emplois/edit.blade.php --}}

@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <h2>Edit Emploi</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('emploi.update', $emploi->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="employeur_id" value="{{Auth::user()->employeur->id}}">
            <div class="form-group my-5">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $emploi->title) }}" required>
            </div>
            <div class="form-group my-5">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $emploi->description) }}</textarea>
            </div>
            <div class="form-group my-5">
                <label for="salary">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary"
                    value="{{ old('salary', $emploi->salary) }}" required>
            </div>
            <div class="form-group my-5">
                <label for="salary">Delay</label>
                <input type="number" class="form-control" id="salary" name="delay" value="{{ old('delay', $emploi->delay) }}" required >
                @error('delay')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
@endsection
