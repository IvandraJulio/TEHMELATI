<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Pengguna (Pelapor)
    Route::get('/dashboard', [DashboardController::class, 'pengguna'])->name('dashboard');
    Route::get('/dashboard/lapor', [DashboardController::class, 'lapor'])->name('dashboard.lapor');
    Route::get('/dashboard/tiket', [DashboardController::class, 'tiketSaya'])->name('dashboard.tiket');

    // Kasubbag
    Route::get('/kasubbag', [DashboardController::class, 'kasubbag'])->name('kasubbag');

    // Solver
    Route::get('/solver', [DashboardController::class, 'solver'])->name('solver');

    // Operator
    Route::get('/operator', [DashboardController::class, 'operator'])->name('operator');
    Route::get('/operator/tiket', [DashboardController::class, 'operatorTiket'])->name('operator.tiket');
    Route::get('/operator/analitik', [DashboardController::class, 'operatorAnalitik'])->name('operator.analitik');

    // AJAX API routes
    Route::get('/api/tickets', [DashboardController::class, 'getTicketsApi']);
    Route::post('/api/tickets', [DashboardController::class, 'createTicketApi']);
    Route::post('/api/tickets/{id}/actions', [DashboardController::class, 'updateTicketActionApi']);
    Route::post('/api/tickets/{id}/comments', [DashboardController::class, 'addCommentApi']);
    Route::post('/api/chat-recommend', [DashboardController::class, 'chatRecommendApi']);

    // Notifications API
    Route::get('/api/notifications', [DashboardController::class, 'getNotificationsApi']);
    Route::post('/api/notifications/read', [DashboardController::class, 'markNotificationsReadApi']);
});
