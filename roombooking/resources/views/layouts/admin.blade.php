<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'RoomBooking Admin') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background-color: #121212;
            color: #fff;
        }
        .sidebar {
            width: 250px;
            background-color: #1f1f1f;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            color: rgba(255,255,255,0.8);
            padding: 1rem;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #333;
            color: #fff;
        }
        main {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="py-4 text-center">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i> Dashboard
        </a>
        <a href="{{ route('admin.rooms.index') }}" class="{{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
            <i class="bi bi-door-closed-fill"></i> Salles
        </a>
        <a href="{{ route('reservations.index') }}" class="{{ request()->routeIs('reservations.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Réservations
        </a>
        <a href="{{ route('calendar.index') }}" class="{{ request()->routeIs('calendar.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-week"></i> Calendrier
        </a>

        {{-- <a href="#">Réservations</a> --}}
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button class="px-3 mt-4 btn w-100 text-start text-danger">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </button>
        </form>
    </div>

    <main>
        @yield('content')
    </main>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
