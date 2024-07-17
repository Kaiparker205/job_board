@extends('layouts.default')
@section('content')
    <!-- Employeur Details -->
    <div class="container my-5">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mr-3">Info Company</h2>
            @if (!$employeur)
                <a href="{{ route('employeur.create') }}" class="btn btn-success ">+ Add employeur</a>
            @endif

        </div>
        @if ($employeur)
            <div class="cart-item bg-light p-3 mb-2">
                <div class="row">
                    <div class="col-md-9">
                        <div class="emplyeur-info">
                            <h5 class="mb-1">Name: {{ Auth::user()->employeur->name }}</h5>
                            <p class="mb-1">Joined: {{ Auth::user()->employeur->created_at->format('M d, Y') }}</p>
                            <p class="mb-1">Last Update: {{ Auth::user()->employeur->updated_at->diffForHumans() }}</p>
                        </div>
                        <!-- CRUD Buttons -->
                        <div class="action-buttons mt-2">
                            <a href="{{ route('employeur.edit', ['employeur' => Auth::user()->employeur]) }}"
                                class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('employeur.destroy', ['employeur' => Auth::user()->employeur]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </div>
    </div>
    <!-- Contact -->
    <div class="container my-5">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mr-3">Info Contact</h2>
            <!-- Link to add a new contact -->
            <a href="{{ route('contact.create') }}" class="btn btn-success ">+ Add Contact</a>
        </div>

        <!-- Loop through each contact associated with the employeur's profile -->

        @forelse (Auth::user()->employeur->contacts as $contact)
            <div class="cart-item bg-light p-3 mb-2">
                <div class="row">
                    <!-- Contact Details -->
                    <div class="col-md-9">
                        <div class="product-info">
                            <h5 class="mb-1">Email : {{ $contact->email }}</h5>
                            <p class="mb-1">Address : {{ $contact->address }}</p>
                            <p class="mb-1">Phone : {{ $contact->phone }}</p>
                            <!-- Other contact details -->
                        </div>
                        <!-- CRUD Buttons for Contact -->
                        <div class="action-buttons mt-2">
                            <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-outline-primary">Edit
                                Contact</a>
                            <form action="{{ route('contact.destroy', $contact) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Remove Contact</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                No Contacts Added Yet
            </div>
        @endforelse
    </div>
@else
    <div class="alert alert-warning my-5">
        add info about your company
    </div>
    @endif
@endsection
