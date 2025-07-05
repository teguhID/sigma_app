<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PaymentController;

use App\Http\Middleware\Csrf;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::post('/payment-notification', [PaymentController::class, 'notification']);
Route::post('/payment-notification/update', [PaymentController::class, 'update'])->name('notification.update');



Route::middleware(['auth'])->group(function () {

    Volt::route('dashboard/', 'dashboard.index')->name('dashboard');
    Volt::route('student/kelas', 'dashboard.student.kelas')->name('student.kelas');
    Volt::route('student/register', 'dashboard.student.register')->name('student.register');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'dashboard.settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'dashboard.settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'dashboard.settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
