<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KullaniciController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;

/*
|---------------------------------------------------------------------------
| Giriş & Kayıt
|---------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/user/home', [KullaniciController::class, 'home'])->name('user.home');


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

/*
|---------------------------------------------------------------------------
| Giriş Sonrası Yönlendirme
|---------------------------------------------------------------------------
*/

// Kullanıcı için


// web.php

Route::get('/araclarim', [VehicleController::class, 'index'])->name('user.vehicles');



Route::get('/arac/{id}', [VehicleController::class, 'show'])->name('vehicle.show');


// routes/web.php

// Kiralama işlemleri menüsü sayfası
Route::get('/rentals', [RentalController::class, 'index'])->name('user.rentals');

// Kiralama formu
Route::get('/rent/{vehicle}', [RentalController::class, 'create'])->name('user.rent.create');

// Kiralama formundan gönderim
Route::post('/vehicles/{id}/rent', [RentalController::class, 'store'])->name('rent.store');

Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('user.vehicle.show');
Route::post('/vehicles/{vehicle}/rent', [VehicleController::class, 'rent'])->name('user.vehicle.rent');
Route::get('/api/vehicle/{id}/rentals', [RentalController::class, 'getRentDates']);

Route::get('/kiralamalarim', [RentalController::class, 'index'])->name('rentals.index');
Route::delete('/kiralama-iptal/{id}', [RentalController::class, 'cancel'])->name('rentals.cancel');

Route::get('/araclar', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/arac/{id}', [VehicleController::class, 'show'])->name('vehicle.show');

Route::get('/profil', [KullaniciController::class, 'profil'])->name('profile.show');
Route::post('/profil', [KullaniciController::class, 'update'])->name('profile.update');
Route::post('/profil/password', [KullaniciController::class, 'updatePassword'])->name('profile.update.password');
Route::post('/rentals/{id}/pay-deposit', [RentalController::class, 'payDeposit'])->name('rentals.payDeposit');

Route::post('/rental/delete', [RentalController::class, 'delete'])->name('rental.delete');

// Bu satır admin prefix'i dışında olmalı
// Kullanıcı tarafı için iletişim sayfası
// Formu göstermek için (GET)
// Kullanıcı formu görüntüler

Route::post('/mesaj-gonder', [MessageController::class, 'store'])->name('contact.send.user');



// Yönetici paneli route’ları (middleware yok)
Route::prefix('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Yönetici ana sayfa (dashboard)
    Route::get('/dashboard', [VehicleController::class, 'adminIndex'])->name('admin.dashboard');

    // Araçlar - listeleme, ekleme, düzenleme, silme
    Route::get('/vehicles', [VehicleController::class, 'adminIndex'])->name('admin.vehicles.index');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('admin.vehicles.update');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('admin.vehicles.destroy');

    // Mesajlar - listeleme ve detay

    // Kiralanan araçlar (admin için kiralama listesi)
   
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/vehicles', [VehicleController::class, 'adminIndex'])->name('admin.vehicles.index');
    Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('admin.rentals.index');
    Route::get('/admin/vehicles/create', [VehicleController::class, 'create'])->name('admin.vehicles.create');
    Route::post('/admin/vehicles', [VehicleController::class, 'store'])->name('admin.vehicles.store');
     Route::get('messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('messages/{id}', [MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('messages/{id}/reply', [MessageController::class, 'reply'])->name('admin.messages.reply');
    Route::delete('messages/{id}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');   

});












