@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="">
            <div class="form-group">
                <label for="trashed">Select Action:</label>
                <select class="form-control" name="trashed" id="trashed">
                    <option value="yes">Expire</option>
                    <option value="no">Steal</option>
                </select>
            </div>
        </form>
    </div>
    <div class="container my-5">

        <table class=" table table-bordered  table-hover">
            <thead class="thead-dark bg-dark text-light">
                <tr>
                    <th class="col">post</th>
                    <th class="col">state</th>
                    <th class="col">date of the job</th>
                    <th class="col">date of the end</th>
                    <th class="col">actions</th>

                </tr>
            </thead>
            <tbody>


                @include('postule.offre_single')
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Function to fetch and render postules based on filters
            function fetchEmplois(filterJob) {
                $.ajax({
                    url: '/postule/offers',
                    type: 'GET',
                    data: {
                        trashed: filterJob
                    },
                    success: function(response) {
                        // Update the table with the filtered postules
                        $('tbody').html(response);
                    }
                });
            }

            // Event listener for the name filter
            $('#trashed').change(function() {
                var filterPost = $('#trashed').val();
                fetchEmplois(filterPost);
            });
        });
    </script>
@endsection
