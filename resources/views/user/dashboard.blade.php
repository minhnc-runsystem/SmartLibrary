@extends('layouts.user')

@section('title', 'Welcome')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            {{-- Greeting --}}
            <h1 class="fw-bold text-primary">📚 Hello, <strong>{{ Auth::user()->name }}</strong>! 👋</h1>
            <p class="fs-5 text-muted">Welcome to <strong>Library Management System</strong> 📖✨</p>

            {{-- Illustration image --}}
            <img src="{{ asset('images/lib.png') }}" class="img-fluid rounded shadow-sm mt-3" alt="Library Image" style="width: 500px; height: 500px;">

            {{-- Library description --}}
            <div class="mt-4">
                <p class="fs-5">
                    📖 Our library offers thousands of interesting books, from fiction, science, history to technology.
                    Discover now and find a book you love! 🎯
                </p>
                <a href="{{ route('user.books') }}" class="btn btn-lg btn-primary mt-3">📖 Discover Books</a>
            </div>
        </div>
    </div>
@endsection
