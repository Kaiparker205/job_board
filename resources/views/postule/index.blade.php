@extends('layouts.default')
@section('content')
    <!-- Employer Details -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="card-title m-0">Applications</h1>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle mx-3" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Manage Email
                    </button>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->employeur->boite)
                            <li><a class="dropdown-item"
                                    href="{{ route('boite.edit', ['boite' => auth()->user()->employeur->boite->id]) }}">Update</a>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('boite.create') }}">Create Email</a></li>
                        @endif

                    </ul>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Manage Applications
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('postule.confirme') }}">Accepted</a></li>
                        <li><a class="dropdown-item" href="{{ route('postule.boite') }}">Boite</a></li>
                        <li><a class="dropdown-item" href="{{ route('postule.offer') }}">Offres</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="filter-post" class="form-label">Filter by Post</label>
                        <select id="filter-post" class="form-select filter">
                            <option value="all">Select a Post</option>
                            @foreach ($emplois as $emploi)
                                <option value="{{ $emploi->id }}">{{ $emploi->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="filter-competence" class="form-label">Filter by Competence</label>
                                <input type="search" name="competence" class="form-control filter" id="filter-competence">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button id="btnSearch" class="btn btn-outline-success w-100">Filter</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered  table-hover">
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        <th scope="col">Date of application</th>
                        <th scope="col">Delay</th>
                    </tr>
                </thead>
                <tbody>
                    @include('postule.postule_single')
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function postuleAction(postuleId, method) {
                $.ajax({
                    url: '/postule/' + postuleId,
                    type: method,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response, status, xhr) {

                        if (xhr.status == 200) {
                            $(`#status-${postuleId}`).html(
                                '<span class="badge bg-success">Confirmed</span>');
                        }

                        if (xhr.status == 204) {
                            $(`#status-${postuleId}`).parent().remove();

                        }
                        console.table(response)
                    }
                });
            }

            $('.form-select').change(function() {
                var selectedAction = $(this).val();
                var postuleId = $(this).data('postule');
                if (selectedAction === 'Confirm') {
                    postuleAction(postuleId, 'PUT')
                } else if (selectedAction === 'Reject') {
                    postuleAction(postuleId, 'DELETE')
                }

            });
        });
        $(document).ready(function() {
            // Function to fetch and render postules based on filters
            function fetchPostules(filterPost, filterComp) {
                $.ajax({
                    url: '/postule',
                    type: 'GET',
                    data: {
                        competence: filterComp,
                        post: filterPost
                    },
                    success: function(response) {
                        // Update the table with the filtered postules
                        $('tbody').html(response);
                    }
                });
            }

            // Event listener for the name filter
            $('.filter').change(function() {
                var filterPost = $('#filter-post').val();
                var filterComp = $.trim($('#filter-competence').val());
                fetchPostules(filterPost);
            });
            $('#btnSearch').click(function() {
                var filterPost = $('#filter-post').val();
                var filterComp = $.trim($('#filter-competence').val());
                fetchPostules(filterPost, filterComp);
            });
        });
    </script>
@endsection
