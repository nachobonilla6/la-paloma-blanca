<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LaPalomaController::class, 'index']);
