@extends('layouts.default')
@section('content')
    <!-- Profil Details -->
    <div class="container my-5">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mr-3">Personnel Information</h2>
            @if (!$profil)
                <a href="{{ route('profile.create') }}" class="btn btn-success ">+ Add CV</a>
            @endif
        </div>
        <div class="cart-item bg-light p-3 mb-2">
            <div class="row">
                <div class="col-md-9">
                    <div class="product-info">
                        <h5 class="mb-2">Name: {{ Auth::user()->name }}</h5>
                        <h5 class="mb-2">Email: {{ Auth::user()->email }}</h5>
                        <h5 class="mb-2">Joined: {{ Auth::user()->created_at->format('M d, Y') }}</h5>
                        <h5 class="mb-2">Last Update: {{ Auth::user()->updated_at->diffForHumans() }}</h5>
                    </div>
                    <!-- CRUD Buttons -->
                    <div class="action-buttons mt-2">
                        <a href="{{ route('profile.edit', ['profile' => Auth::user()]) }}"
                            class="btn btn-outline-primary">Edit Profile</a>
                        <a href="{{ route('cv.edit') }}" class="btn btn-outline-primary">Edit CV</a>
                        <form action="{{ route('profile.destroy', ['profile' => Auth::user()->id]) }}" method="POST"
                            class="d-inline">
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
    @if ($profil)
        <!-- diplome -->
        <div class="container my-5">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h2 class="mb-0 mr-3">Diplomas</h2>
                <!-- Link to add a new diploma -->
                <a href="{{ route('diplome.create') }}" class="btn btn-success ">+ Add Diploma</a>
            </div>

            <!-- Loop through each diploma associated with the user's profile -->


            @forelse ($profil->diplomes as $diplome)
                <div class="cart-item bg-light p-3 mb-2">
                    <div class="row">
                        <!-- Diplome Details -->
                        <div class="col-md-9">
                            <div class="product-info">
                                <h5 class="mb-1">Type: {{ $diplome->type }}</h5>
                                <p class="mb-1">Place: {{ $diplome->place }}</p>
                                <!-- Other diploma details -->
                            </div>
                            <!-- CRUD Buttons for Diploma -->
                            <div class="action-buttons mt-2">
                                <a href="{{ route('diplome.edit', $diplome->id) }}" class="btn btn-outline-primary">Edit
                                    Diploma</a>
                                <form action="{{ route('diplome.destroy', $diplome) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Remove Diploma</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    No Diplomas Added Yet
                </div>
            @endforelse
        </div>
        <!-- competence -->
        <div class="container my-5">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h2 class="mb-0 mr-3">Competences</h2>
                <!-- Link to add a new competence -->
                <a href="{{ route('competence.create') }}" class="btn btn-success ">+ Add Competence</a>
            </div>

            @forelse ($profil->competences as $competence)
                <div class="cart-item mb-3 bg-light p-3 mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $competence->name }}</h5>
                        <p class="card-text">{{ $competence->description }}</p>
                        <!-- CRUD Buttons for Competence -->
                        <a href="{{ route('competence.edit', $competence->id) }}" class="btn btn-outline-primary">Edit
                            Competence</a>
                        <form action="{{ route('competence.destroy', $competence) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Remove Competence</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class=" alert alert-warning">No competencies added yet.</div>
            @endforelse


        </div>
    @endif

    </div>
@endsection
