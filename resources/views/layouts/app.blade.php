<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Đảm bảo trang luôn full chiều cao */
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .footer {
            background: #343a40
            color: white;
            padding: 15px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.books') }}">Library Online</a>
        </div>
    </nav>

    <!-- Nội dung chính -->
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
