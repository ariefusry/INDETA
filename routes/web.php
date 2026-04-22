<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login.html');
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

Route::get('/destinasi/{slug}', function ($slug) {
    return view('user.destinasi_detail', ['slug' => $slug]);
});

Route::get('/artikel', function () {
    return view('user.artikel');
});

Route::get('/artikel/{slug}', function ($slug) {
    return view('user.artikel_detail', ['slug' => $slug]);
});
