<?php

namespace App\routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\User\UserBookController;
use App\Http\Controllers\User\UserBorrowController;
use App\Http\Controllers\Admin\BorrowController;
use App\Http\Controllers\Admin\BorrowRequestController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserProfileController;

// Home page
Route::get('/', [HomeController::class, 'index']);

// Authentication routes
Route::get('/login', [AuthenticationController::class, 'getLoginView'])->name('login'); // display login form
Route::post('/login', [AuthenticationController::class, 'login'])->name('login'); // login user
Route::get('/register', [AuthenticationController::class, 'getRegisterView'])->name('register'); // display register form
Route::post('/register', [AuthenticationController::class, 'register'])->name('register'); // register user
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout'); // logout user

Route::prefix('admin')->middleware(AdminMiddleware::class, AuthMiddleware::class)->group(function () {
    Route::get('/', [HomeController::class, 'admin'])->name('admin'); // display admin dashboard
    Route::get('/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard'); // display admin dashboard

    // User management
    Route::get('/users', [UserController::class, 'user'])->name('admin.users'); // display all users    
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create'); // display create user form
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); // display edit user form
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store'); // save new user
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update'); // update user information    
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // delete user

    // Category management
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories'); // display all categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create'); // display create category form
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store'); // save new category
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit'); // display edit category form
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update'); // update category information
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy'); // delete category


    // Book management
    Route::get('/books', [BookController::class, 'index'])->name('admin.books'); // display all books
    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create'); // display create book form
    Route::get('/books/{book}', [BookController::class, 'show'])->name('admin.books.show'); // display book information
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit'); // display edit book form
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store'); // save new book
    Route::put('/books/{book}', [BookController::class, 'update'])->name('admin.books.update'); // update book information
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy'); // delete book

    // Borrow management
    Route::get('/borrows', [BorrowController::class, 'getBorrows'])->name('admin.borrows'); // display all borrows
    Route::get('/borrow-requests', [BorrowRequestController::class, 'getBorrowRequests'])->name('admin.borrow-requests'); // display all borrow requests
    Route::post('/borrow-requests/{request}/approve', [BorrowRequestController::class, 'approveRequest'])->name('admin.requests.approve'); // approve borrow request
    Route::post('/borrow-requests/{request}/reject', [BorrowRequestController::class, 'rejectRequest'])->name('admin.requests.reject'); // reject borrow request
    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('admin.borrow.confirm-return'); // confirm return book
});


// User routes
Route::prefix('user')->middleware(AuthMiddleware::class)->group(function () {

    Route::get('/', [HomeController::class, 'user'])->name('user'); // display user dashboard  
    Route::get('/dashboard', [HomeController::class, 'user'])->name('user.dashboard'); // display user dashboard  

    // Book management
    Route::get('/books', [UserBookController::class, 'index'])->name('user.books'); // display all books
    Route::get('/books/{book}', [UserBookController::class, 'show'])->name('user.books.show'); // display book information

    // Borrow management
    Route::get('/borrow-history', [UserBorrowController::class, 'index'])->name('user.borrow.history'); // display borrow history
    Route::get('/requests/pending', [UserBorrowController::class, 'getPendingRequests'])->name('user.requests.pending'); // display pending requests
    Route::get('/requests/rejected', [UserBorrowController::class, 'getRejectedRequests'])->name('user.requests.rejected'); // display rejected requests
    Route::post('/books/{book}/borrow', [UserBorrowController::class, 'requestBorrow'])->name('user.books.borrow'); // request borrow book

    // Profile management
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

});



