@extends('layouts.default')
@section('content')
    {{-- resources/views/emplois/index.blade.php --}}
    <div class="container mt-5">


        <div class="d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mr-3">List of Jobs</h2>

            @can('create', App\Models\Emploi::class)
                <a href="{{ route('emploi.create') }}" class="btn btn-success ">+ Add Job</a>
            @endcan

        </div>

        <div class="row d-flex">
            <div class="col-9">
                <input type="search" class="form-control  " placeholder="Search">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary w-100 " id="btn-search">Search</button>
            </div>
        </div>
        <div id="conteinerEmplois">

            @include('emploi.single_emploi')
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {

                $('#btn-search').click(function() {

                    const searchTerm = $('input[type="search"]').val();
                    // Send an AJAX request to the server to filter emplois
                    $.ajax({
                        url: '/emploi',
                        method: 'GET',
                        data: {
                            page:1,
                            search: searchTerm
                        },
                        success: function(response) {

                            // Update the view with the filtered emplois
                            $('#conteinerEmplois').html(response);
                        },
                        error: function(error) {
                            console.error('Error fetching filtered emplois:', error);
                        }
                    });
                });

//    pagination
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');
                    var myurl = $(this).attr('href');
                    var page = $(this).attr('href').split('page=')[1];
                    getData(page);
                });


            function getData(page) {
                const searchTerm = $('input[type="search"]').val();

                $.ajax({
                    url: '/emploi',
                    type: "get",
                    data: {
                        page: page,
                        search: searchTerm
                        },
                        success: function(response) {

                            // Update the view with the filtered emplois
                            $('#conteinerEmplois').html(response);
                        },
                        error: function(error) {
                            console.error('Error fetching filtered emplois:', error);
                        }
                    });
            }    })  ;
        </script>
    @endsection
