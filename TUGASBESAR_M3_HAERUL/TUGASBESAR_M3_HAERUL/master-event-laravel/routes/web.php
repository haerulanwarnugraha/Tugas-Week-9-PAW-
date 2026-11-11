<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Route Utama mengarah ke daftar event
Route::get('/', function () {
    return redirect()->route('events.index');
});

// Halaman Login Simulasi Role & Guest
Route::get('/login', function () {
    return '
        <div style="font-family: Arial; padding: 50px; text-align: center; max-width: 650px; margin: 0 auto;">
            <h2>Halaman Login Simulasi Role</h2>
            <p style="color: #555; margin-bottom: 25px;">Silakan pilih hak akses untuk menguji modul:</p>
            
            <!-- Tombol Admin & Staff Berjajar di Atas -->
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; margin-bottom: 25px;">
                <a href="/login-as/admin" style="background: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold;">Login sebagai Admin</a>
                <a href="/login-as/staff" style="background: #16a34a; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold;">Login sebagai Staff</a>
            </div>

            <!-- Teks Murni Guest di Bawah -->
            <div>
                <a href="/login-as/guest" style="color: #4b5563; text-decoration: underline; font-size: 15px; font-weight: 500;">Login sebagai Guest</a>
            </div>
        </div>
    ';
})->name('login');

// Route helper untuk simulasi login cepat atau logout guest
Route::get('/login-as/{role}', function ($role) {
    if ($role === 'guest') {
        // Jika sebagai guest, pastikan user melakukan logout
        Auth::logout();
        return redirect()->route('events.index');
    }

    $user = User::where('role', $role)->first();
    if ($user) {
        Auth::login($user);
        return redirect()->route('events.index');
    }
    return "User dengan role {$role} tidak ditemukan. Jalankan php artisan db:seed terlebih dahulu.";
});

// Route logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Semua route di bawah ini wajib login (auth)
Route::middleware(['auth'])->group(function () {
    
    // Admin & Staff bisa melihat, menambah, dan mengedit data
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

    // KHUSUS ADMIN: Hanya role admin yang boleh menghapus data event (Dilindungi middleware role:admin)
    Route::delete('/events/{event}', [EventController::class, 'destroy'])
         ->middleware('role:admin')
         ->name('events.destroy');
});