<?php
 
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
 
// ===== POV USER ===== //
Route::get('/', [HomeController::class, 'beranda'])->name('user.beranda');
Route::get('/katalog-buku', [HomeController::class, 'katalogBuku'])->name('user.katalog-buku');
  
// ===== PENGARAH SETELAH LOGIN / REGISTER ===== //
Route::get('/dashboard', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
 
    return redirect()->route('user.beranda');
})->middleware('auth')->name('dashboard');

// ===== PROFIL (semua yang sudah login) ===== //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
// ===== POV ADMIN (wajib login DAN role admin) ===== //
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    Route::resource('buku', BukuController::class);
});
 
require __DIR__.'/auth.php';
