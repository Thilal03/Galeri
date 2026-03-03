<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Frontend\GaleriController as FrontendGaleriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/galeri', [DashboardController::class, 'galeri'])->name('dashboard.galeri');

    // Frontend Galeri Routes (View Only for All Authenticated Users)
    Route::get('/galeri', [FrontendGaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/{slug}', [FrontendGaleriController::class, 'show'])->name('galeri.show');

    // ========================
    // GURU ROUTES (View Only for Regular Users)
    // ========================
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/{id}', [GuruController::class, 'show'])->name('guru.show')->where('id', '[0-9]+');

    // ========================
    // SISWA ROUTES (View Only for Regular Users)
    // ========================
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show')->where('id', '[0-9]+');

    // ========================
    // PROFILE ROUTES
    // ========================
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| Admin & Guru Routes (Auth + Role Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role: admin,guru,'])->group(function () {
     
    // Galeri Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('galeri', AdminGaleriController::class);
        Route::delete('galeri/photo/{id}', [AdminGaleriController::class, 'deletePhoto'])->name('galeri.photo.delete');
    });

    // Guru Management Routes (Admin & Guru)
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/create', [GuruController::class, 'create'])->name('create')->middleware('role:admin');
        Route::post('/store', [GuruController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [GuruController::class, 'edit'])->name('edit')->middleware('role:guru');
        Route::put('/{id}/update', [GuruController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [GuruController::class, 'delete'])->name('delete')->middleware('role:admin');
    });

    // Siswa Management Routes (Admin & Guru)
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/store', [SiswaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [SiswaController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [SiswaController::class, 'delete'])->name('delete');
    });
});


// Route for serving photos
Route::get('/storage/galeri/{filename}', function ($filename) {
    $path = storage_path('app/public/galeri/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->name('galeri.photo');
