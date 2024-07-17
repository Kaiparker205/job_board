@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <!-- Dashboard Widgets -->
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Jobs</h5>
                    <p class="card-text">{{ $totalJobs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Active Applications</h5>
                    <p class="card-text">{{ $totalApplications }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Listings Table -->
    <div class="card mb-4">
        <div class="card-header">
            Job Listings
        </div>
        <div class="card-body">
            <div class="mb-3">
                <input type="text" id="job-search" class="form-control" placeholder="Search jobs...">
            </div>
            <div class="table-responsive" id="jobs-table">
                @include('admin.jobs.jobs_table')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function fetchJobs(page, query) {
            $.ajax({
                url: "{{ route('admin.jobs.filter') }}",
                data: {
                    page: page,
                    search: query
                },
                success: function(data) {
                    $('#jobs-table').html(data.jobs);
                    $('.pagination-links').html(data.pagination);
                }
            });
        }

        $(document).on('keyup', '#job-search', function() {
            var query = $(this).val();
            fetchJobs(1, query);
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var query = $('#job-search').val();
            fetchJobs(page, query);
        });
    });
</script>
@endsection
