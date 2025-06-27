<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="border-bottom: 1px solid #c5c0c0;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'TaskFlow') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Notifications Dropdown -->
                        @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownNotifications" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Notifications
                                @if(auth()->user()->unreadNotifications->count())
                                    <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @forelse(auth()->user()->notifications as $notification)
                                    @php
                                        $data = $notification->data;
                                    @endphp

                                    {{-- Task Assigned Notification --}}
                                    @if(isset($data['task_id']) && isset($data['task_title']))
                                        <a href="{{ route('tasks.show', ['task' => $data['task_id'], 'notification' => $notification->id]) }}"
                                           class="dropdown-item notification-link {{ is_null($notification->read_at) ? 'fw-bold bg-light-gray' : '' }}"
                                           data-notification-id="{{ $notification->id }}">
                                            <i class="fas fa-tasks me-1"></i>
                                            New Task: {{ $data['task_title'] }} in {{ $data['project_name'] ?? 'Project' }}
                                            @if(is_null($notification->read_at))
                                                <span class="badge bg-danger ms-2">New</span>
                                            @endif
                                        </a>
                                        <hr>
                                    {{-- Project Assigned Notification --}}
                                    @elseif(isset($data['project_id']) && isset($data['project_name']))
                                        <a href="{{ route('projects.show', ['project' => $data['project_id'], 'notification' => $notification->id]) }}"
                                           class="dropdown-item notification-link {{ is_null($notification->read_at) ? 'fw-bold bg-light-gray' : '' }}"
                                           data-notification-id="{{ $notification->id }}">
                                            <i class="fas fa-folder-plus me-1"></i>
                                            New Project Assigned: {{ $data['project_name'] }}
                                            @if(is_null($notification->read_at))
                                                <span class="badge bg-danger ms-2">New</span>
                                            @endif
                                        </a>
                                        <hr>
                                    @endif
                                @empty
                                    <span class="dropdown-item text-muted">No notifications</span>
                                @endforelse
                            </div>
                        </li>
                        @endauth
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.notification-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                var notificationId = this.getAttribute('data-notification-id');
                if (notificationId && this.classList.contains('fw-bold')) {
                    fetch('/notifications/' + notificationId + '/read', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            // Update badge count
                            let badge = document.querySelector('#navbarDropdownNotifications .badge');
                            if (badge) {
                                let count = parseInt(badge.textContent);
                                if (count > 1) badge.textContent = count - 1;
                                else badge.remove();
                            }
                            // Optionally, remove bold style and "New" badge
                            this.classList.remove('fw-bold');
                            let newBadge = this.querySelector('.bg-danger');
                            if (newBadge) newBadge.remove();
                        }
                    });
                }
            });
        });
    });
    </script>
</body>
</html>
