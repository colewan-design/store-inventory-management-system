<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
?>