<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Corrected the path separators -->
    <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Added Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="icon" href={{ asset('images/logo.jpg') }} type="image/x-icon" />
    <title>Job Board</title>
</head>

<body>
    <header class="bg-dark text-light">
        <a href="/" style="text-decoration: none;color:white;"><span class="Logo text">JOBBOARD</span></a>

        <nav>
            <ul class="menu">
                <li><a href="{{ route('emploi.index') }}" class="btn btn-outline-light">+ Post a job</a></li>
                @auth
                    <!-- Dropdown Trigger -->


                    <!-- Dropdown Trigger -->
                    <li class="nav-item dropdown">
                        <button id="navbarDropdown" class="dropdown-toggle btn btn-secondary" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                @if (Auth::user()->role_id == 3)
                            <li><a href="{{ route('admin.index') }}" class="dropdown-item">Admin Panel</a></li>
                            @endif
                    </li>
                    @if (Auth::user()->role_id == 2)
                        <li><a class="dropdown-item" href="{{ route('employeur.index') }}">Company</a></li>
                    @endif

                    @if (Auth::user()->employeur)
                        <li><a class="dropdown-item" href="{{ route('postule.index') }}">Postule</a></li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                        </form>
                    </li>
                </ul>
                </li>

            @endauth

            @guest
                <li><a href="/register" class="btn btn-success">Register</a></li>
                <li><a href="/login" class="btn btn-success">Log In</a></li>
            @endguest
            </ul>
        </nav>

    </header>
    <div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
    </div>

    @yield('content')

    <!-- Corrected the path separators for script tags -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
    @yield('scripts')

    <footer class="bg-dark text-light text-center py-3">
        <div class="container">
            <p>© 2024 My Website. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>
