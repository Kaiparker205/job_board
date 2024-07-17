
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            @forelse ($emplois as $emploi)
            <div class="container my-5">
                <div class="row">
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h5 class="card-title">{{ $emploi->title }}</h5>
                                </div>
                                <h6 class="card-subtitle mb-2 text-muted">Company: {{ $emploi->employeur->name }}</h6>
                                <p class="card-text">{{ $emploi->description }}</p>
                                <p class="card-text"><strong>Salary:</strong> {{ $emploi->salary }}</p>
                                <p class="card-text"><strong>Posted date:</strong> {{ $emploi->created_at->diffForHumans() }}</p>
                                <p class="card-text"><strong>Expiration date:</strong>
                                    @php
                                        $date = new DateTime($emploi->updated_at);
                                        $date->modify('+' . $emploi->delay . ' day');
                                    @endphp
                                    {{ $date->format('d-m-Y') }}
                                </p>
                                <a href="{{ route('emploi.show', $emploi) }}" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @empty
                <div class="alert alert-danger">
                    No Emplois found
                </div>
            @endforelse
            <div class="d-flex justify-content-center">
                {{ $emplois->appends(['search' => $search_term])->links() }}
            </div>
        </div>
    </div>


