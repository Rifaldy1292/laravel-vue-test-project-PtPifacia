<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\JwtAuthMiddleware;
use App\Http\Controllers\UserController
;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware([JwtAuthMiddleware::class])->post('/new-role', [RoleController::class, 'store']);
Route::middleware([JwtAuthMiddleware::class])->delete('/delete-role/{id}', [RoleController::class, 'destroy']);
Route::middleware([JwtAuthMiddleware::class])->put('/edit-role/{id}', [RoleController::class, 'update']);



Route::middleware([JwtAuthMiddleware::class])->get('/all-role', [RoleController::class, 'index']);
Route::middleware([JwtAuthMiddleware::class])->get('/all-users', [UserController::class, 'index']);
