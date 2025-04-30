<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController\AuthUsers;

Route::post('/register', [AuthUsers::class, 'register'])->name('register');
