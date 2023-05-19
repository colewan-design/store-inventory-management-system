<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
//Exports
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;

// Public API routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

//Accounts
Route::get('/accounts', [AccountsController::class, 'index']);
Route::post('/accounts/create', [AccountsController::class, 'store']);
Route::put('/accounts/update/{id}', [AccountsController::class, 'update']);
Route::delete('/accounts/delete/{id}', [AccountsController::class, 'destroy']);


?>