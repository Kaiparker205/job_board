@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <img src='{{ asset("$profil->profil_path") }}' class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <h2 class="card-title text-center">{{ $profil->user->name }}</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ asset("$profil->cv_path") }}" target='_blank' class="btn btn-primary w-100">See CV </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Competences</h3>
                        <ul class="list-group list-group-flush">
                            @forelse ($profil->competences as $competence)
                                <li class="list-group-item">{{ $competence->name }} : {{ $competence->description }}</li>
                            @empty
                                <li class="list-group-item">No competences</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Diplomes</h3>
                        <ul class="list-group list-group-flush">
                            @forelse ($profil->diplomes as $diplome)
                                <li class="list-group-item">{{ $diplome->type }} : {{ $diplome->description }}</li>
                            @empty
                                <li class="list-group-item">No diplomes</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
