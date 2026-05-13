<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login.html', function () {
    return view('login');
});

Route::get('/register.html', function () {
    return view('register');
});

Route::get('/index.html', function () {
    return view('user.index');
});

Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/destinasi', function () {
    return view('user.destinasi');
});

Route::get('/categories', function () {
    return view('user.categories');
});

Route::get('/categories/{slug}', function ($slug) {
    return view('user.categories_detail', ['slug' => $slug]);
});

Route::get('/product/{slug}', function ($slug) {
    return view('user.product_detail', ['slug' => $slug]);
})->name('user.product_detail');

Route::get('/destinasi/{slug}', function ($slug) {
    return view('user.destinasi_detail', ['slug' => $slug]);
});

Route::get('/product', function () {
    return view('user.product');
});

Route::get('/artikel', function () {
    return view('user.artikel');
});

Route::get('/artikel/{slug}', function ($slug) {
    return view('user.artikel_detail', ['slug' => $slug]);
});

Route::prefix('admin-dashboard')->group(function () {
    Route::get('/destinasi', function () { return view('admin.destinasi'); });
    Route::get('/kategori', function () { return view('admin.kategori'); });
    Route::get('/artikel', function () { return view('admin.artikel'); });
    Route::get('/umkm', function () { return view('admin.umkm'); });
    Route::get('/paket', function () { return view('admin.paket'); });
});
