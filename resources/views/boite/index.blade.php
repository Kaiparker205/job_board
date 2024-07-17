<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>@yield('title')</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }

        .header {
            background-color: #343a40; /* Dark gray header */
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="#" class="logo">JOBBOARD</a>
    </header>

    <main class="container my-5">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Hi, {{ $data->username }}</h3>
                        <p class="card-text">From :{{ $data->name }}</p>

                        <p class="card-text lead">{{ $data->content }}</p>
                        <p class="card-text">We are so happy to have you on our website.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
