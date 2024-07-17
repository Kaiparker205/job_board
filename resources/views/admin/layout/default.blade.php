<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board</title>
    <link rel="icon" href={{ asset('images/logo.jpg') }} type="image/x-icon" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="/">Job Board</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('admin.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.users') }}" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.rapport') }}" class="sidebar-link collapsed has-dropdown"
                        data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Offres</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.static') }}" class="sidebar-link collapsed"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                static
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.rank') }}" class="sidebar-link collapsed"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                rank
                            </a>

                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.company') }}" class="sidebar-link collapsed"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                company
                            </a>

                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.rapport') }}" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Report</span>
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <form id="logout-form" class="form-inline mt-md-auto mt-2" method="POST"
                    action="{{ route('logout') }}">
                    @csrf
                    <a href="#" class="sidebar-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </div>
        </aside>
        <div class="main p-3">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="{{ asset('script.js') }}"></script>
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000, // Duration in milliseconds
                gravity: "top", // `top` or `bottom`
                position: 'right', // `left`, `center`, or `right`
                backgroundColor: "#4CAF50", // Background color
            }).showToast();
        </script>
    @endif

    @if (session('fail'))
        <script>
            Toastify({
                text: "{{ session('fail') }}",
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "#F44336",
            }).showToast();
        </script>
    @endif

    @yield('scripts')
</body>

</html>
