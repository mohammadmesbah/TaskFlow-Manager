<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @endif
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="display-4 fw-bold">Welcome to TaskFlow Manager Website</h1>
                    <p class="lead">Start Adding your next project, tasks today!</p>
                </div>
            </div>

            @if (Route::has('login'))
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="text-center">
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <footer class="mt-auto py-4 bg-light">
            <div class="container text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Mesbah. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
