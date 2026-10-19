<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/publikasi', [PublicController::class, 'posts'])->name('posts.index');
Route::get('/publikasi/{post:slug}', [PublicController::class, 'showPost'])->name('posts.show');
Route::get('/tentang-kami', [PublicController::class, 'about'])->name('about');
Route::get('/satuan/{unit:slug}', [PublicController::class, 'unit'])->name('units.show');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('publikasi', PostController::class)->except(['show'])->parameters(['publikasi' => 'post']);
        Route::resource('anggota', MemberController::class)->except(['show'])->parameters(['anggota' => 'member']);
        Route::resource('struktur', StructureController::class)->except(['show'])->parameters(['struktur' => 'structure']);
        Route::get('/pengaturan', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/pengaturan', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/pesan', [MessageController::class, 'index'])->name('messages.index');
        Route::delete('/pesan/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });
});
