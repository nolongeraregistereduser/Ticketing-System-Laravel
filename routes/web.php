<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminTicketController; // Import the AdminTicketController
use App\Http\Controllers\AdminUsersManagementController; // Import the new controller
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

// Routes for regular users (role: user)
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Basic ticket routes for users
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});

// Routes for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin routes for categories
    Route::prefix('admin')->group(function () {
        // Categories management
        Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

        // Ticket management
        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
        Route::get('/tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])->name('admin.tickets.assign');
        Route::post('/tickets/{ticket}/assign', [AdminTicketController::class, 'updateAssignment'])->name('admin.tickets.updateAssignment');
        Route::get('/tickets/{ticket}/edit', [AdminTicketController::class, 'edit'])->name('admin.tickets.edit');
        Route::put('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])->name('admin.tickets.updateStatus');

        // User management routes
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminUsersManagementController::class, 'index'])->name('admin.users.index');
            Route::get('/create', [AdminUsersManagementController::class, 'create'])->name('admin.users.create');
            Route::post('/', [AdminUsersManagementController::class, 'store'])->name('admin.users.store');
            Route::get('/{user}/edit', [AdminUsersManagementController::class, 'edit'])->name('admin.users.edit');
            Route::patch('/{user}', [AdminUsersManagementController::class, 'update'])->name('admin.users.update');
            Route::delete('/{user}', [AdminUsersManagementController::class, 'destroy'])->name('admin.users.destroy');
        });
    });
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:agent'])->prefix('agent')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\TicketController::class, 'agentDashboard'])->name('agent.dashboard');

    Route::get('/tickets/{ticket}/edit', [App\Http\Controllers\TicketController::class, 'editAgentTicket'])->name('agent.tickets.edit');
    Route::put('/tickets/{ticket}', [App\Http\Controllers\TicketController::class, 'updateAgentTicket'])->name('agent.tickets.update');
});
