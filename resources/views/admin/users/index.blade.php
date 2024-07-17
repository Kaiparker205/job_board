@extends('admin.layout.default')
@section('content')
    <!-- Employer Details -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">List of Users</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="filter-name" class="form-label">Filter by Name</label>
                        <input type="text" name="name" id="filter-name" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="col-md-3">
                        <label for="filter-role" class="form-label">Filter by Role</label>
                        <div class="input-group">
                            <select id="filter-role" class="form-select filter">
                                <option value="1">Condidat</option>
                                <option value="2">Company</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button class="btn btn-primary " id="filter">Filter</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th scope="col">#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @include('admin.users.single_user')
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Function to fetch and render postules based on filters
            function fetchUsers(filterRole, filterName) {
                let data =(filterName==='')?{role: filterRole}:{role: filterRole, name: filterName};
                $.ajax({
                    url: '/admin/users',
                    type: 'GET',
                    data: {
                      ...data
                    },
                    success: function(response) {
                        // Update the table with the filtered postules
                        $('tbody').html(response);
                        $('#role').val(filterRole);
                    }
                });
            }

            // Event listener for the role filter
            $('#filter').click(function() {
                var filterRole = $('#filter-role').val();
                var filterName = $('#filter-name').val();
                fetchUsers(filterRole, filterName);
            });

            function    userAction(userId, method) {
                var filterRole = $('#filter-role').val();
                var filterName = $('#filter-name').val();
            
                $.ajax({
                    url: ' /admin/'+userId,
                    type: method,
                    data: {
                        id: userId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response, status, xhr) {
                        fetchUsers(filterRole, filterName)
                        console.table(response)
                    }
                });
            }

            $('.form-select').change(function() {
                var selectedAction = $(this).val();
                var userId = $(this).data('user');
                if (selectedAction === 'Confirm') {
                    userAction(userId, 'PUT')
                } else if (selectedAction === 'Reject') {
                   userAction(userId, 'DELETE')
                }

            });

        });
    </script>
@endsection
