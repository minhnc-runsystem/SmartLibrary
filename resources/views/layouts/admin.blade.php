<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang Quản Trị')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensure footer is always at the bottom */
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .footer {
            background: #343a40;
            color: white;
            padding: 15px 0;
        }
        /* Custom Navbar */
        .navbar {
            padding: 12px 20px;
            border-radius: 0 0 12px 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #343a40 !important;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .navbar-nav .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
            padding: 10px 15px;
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
        }
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .logout-btn {
            background-color: #dc3545 !important;
            border: none;
            padding: 10px 15px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
        }
        .logout-btn:hover {
            background-color: #bb2d3b !important;
        }
    </style>
</head>
<body>
    <!-- Navbar Admin -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">⚙️ Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.books') }}">Manage Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories') }}">Manage Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Manage Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.borrows') }}">Manage Borrow</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.borrow-requests') }}">Borrow Request</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn logout-btn text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container mt-4 content">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Fixed footer -->
    <footer class="footer mt-auto text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 Library Online. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
