<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.   Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::get('/users', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/active-inactive/{id}', [UserController::class, 'activeInactive']);

    // project
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/project/store', [ProjectController::class, 'store']);
    Route::get('/project/edit/{id}', [ProjectController::class, 'edit']);
    Route::post('/project/update/{id}', [ProjectController::class, 'update']);


    // Task
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/task/store', [TaskController::class, 'store']);
    Route::get('/task/edit/{id}', [TaskController::class, 'edit']);
    Route::post('/task/update/{id}', [TaskController::class, 'update']);
    Route::post('/task/user/update/{id}', [TaskController::class, 'taskUpdate']);
    Route::get('/task/user-project', [TaskController::class, 'getProjectAndUser']);

    Route::post('/upload-tasks', [TaskController::class, 'uploadTasks']);


});
