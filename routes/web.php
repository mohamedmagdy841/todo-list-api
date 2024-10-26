<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;

Route::get('/', function () {
    return view('welcome');
});


