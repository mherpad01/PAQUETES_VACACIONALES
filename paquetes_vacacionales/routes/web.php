<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Listado completo de paquetes
Route::get('/vacaciones', [VacacionController::class, 'index'])->name('vacaciones.index');

// Dashboard - requiere autenticación
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil - requiere autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// VACACIONES - Index y show públicos, resto protegido
Route::get('/vacaciones', [VacacionController::class, 'index'])->name('vacaciones.index');
Route::get('/vacaciones/{vacacion}', [VacacionController::class, 'show'])->name('vacaciones.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/vacaciones-create', [VacacionController::class, 'create'])->name('vacaciones.create');
    Route::post('/vacaciones', [VacacionController::class, 'store'])->name('vacaciones.store');
    Route::get('/vacaciones/{vacacion}/edit', [VacacionController::class, 'edit'])->name('vacaciones.edit');
    Route::put('/vacaciones/{vacacion}', [VacacionController::class, 'update'])->name('vacaciones.update');
    Route::delete('/vacaciones/{vacacion}', [VacacionController::class, 'destroy'])->name('vacaciones.destroy');
});

// RESERVAS - Solo usuarios autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/vacaciones/{vacacion}/reservar', [ReservaController::class, 'store'])->name('reservas.store');
    Route::delete('/vacaciones/{vacacion}/cancelar-reserva', [ReservaController::class, 'destroy'])->name('reservas.destroy');
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])->name('reservas.mis-reservas');
});

// COMENTARIOS - Solo usuarios autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/vacaciones/{vacacion}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::put('/comentarios/{comentario}', [ComentarioController::class, 'update'])->name('comentarios.update');
    Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
});

// Rutas de administración (solo admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});

require __DIR__.'/auth.php';