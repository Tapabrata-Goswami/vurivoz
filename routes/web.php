<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.adminLogin');
});

// Authentication --


// Dashboard --
Route::get('/dashboard', function(){
    return view('admin.dashboard');
});