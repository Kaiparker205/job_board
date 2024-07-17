@extends('layouts.default')
@section('content')
    <!-- Employer Details -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
<h5 class="mb-0">Postule Confirme</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <label for="filter-post" class="form-label">Filter by Post</label>
                        <div class="input-group">
                            <select id="filter-post" class="form-select filter">
                                <option value="">All</option>
                                @foreach ($emplois as $emploi)
                                    <option value="{{ $emploi->id }}">{{ $emploi->title }}</option>
                                @endforeach
                            </select>
                            @if (auth()->user()->employeur->boite)

                            <form action="{{ route('send') }}" method="get">
                                <input type="hidden" name="post" id="post">
                                <input type="submit" value="Send Email" class="btn btn-outline-success" id="btnSendEmail">
                            </form>
                            @endif
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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @include('postule.postule_confirme_single')
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
                    url: '/postule/confirme',
                    type: 'GET',
                    data: {
                        post: filterPost
                    },
                    success: function(response) {
                        // Update the table with the filtered postules
                        $('tbody').html(response);
                        $('#post').val(filterPost);
                    }
                });
            }

            // Event listener for the name filter
            $('.filter').change(function() {
                var filterPost = $('#filter-post').val();
                fetchPostules(filterPost);
            });
        });
    </script>
@endsection
