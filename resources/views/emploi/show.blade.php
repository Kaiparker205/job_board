@extends('layouts.default')

@section('content')
    <div class="container my-5">
        <!-- Employment Details and Contact Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">{{ $emploi->title }}</h5>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-3 text-muted">Company : {{ $emploi->employeur->name }}</h6>
                <p class="card-text">Description : {{ $emploi->description }}</p>
                <p class="card-text"><strong>Salary:</strong> {{ $emploi->salary }}</p>

                <!-- Contact Information -->
                <div class="contact-info mt-4">
                    <h5 class="mb-3">Info Contact</h5>
                    @if ($contact)
                        <p class="mb-1"><strong>Email:</strong> {{ $contact->email }}</p>
                        <p class="mb-1"><strong>Address:</strong> {{ $contact->address }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $contact->phone }}</p>
                    @else
                        <p>No contacts found.</p>
                    @endif
                </div>
            </div>
            <hr>
            @auth


                <div class="cart-foote">
                    <form action="{{ route('postule.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="emploi_id" value="{{ $emploi->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="post" value="{{ $emploi->title }}">
                        <input class="btn btn-primary w-100" type="submit" value="postuler">
                    </form>

                </div>
            @endauth
        </div>
    </div>
@endsection

@section('css')
    <style>
        .contact-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }

        .card-header {
            font-size: 1.25rem;
        }
    </style>
@endsection
