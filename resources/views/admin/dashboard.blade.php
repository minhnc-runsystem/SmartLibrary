@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            {{-- Greeting Admin --}}
            <h1 class="fw-bold text-primary">📊 Hello, <strong>{{ Auth::user()->name }}</strong>! 👋</h1>
            <p class="fs-5 text-muted">Welcome to <strong>Library Management System</strong> 📚</p>

            {{-- Illustration image --}}
            <img src="{{ asset('images/lib-admin.jpg') }}" class="img-fluid rounded shadow-sm mt-3" 
                 alt="Admin Dashboard Image" style="width: 500px; height: 400px;">

            {{-- Information for Admin --}}
            <div class="mt-4">
                <p class="fs-5">
                    🎯 Here, you can <strong>manage books, users and borrow requests</strong>.  
                    Please approve the borrow requests, update the book stock and ensure the library operates smoothly!
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('admin.books') }}" class="btn btn-lg btn-primary">📚 Manage Books</a>
                    <a href="{{ route('admin.borrow-requests') }}" class="btn btn-lg btn-warning">📜 Approve Requests</a>
                </div>
            </div>
        </div>
    </div>
@endsection
