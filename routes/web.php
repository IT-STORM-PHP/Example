<?php
    use App\Routes\Route;
    use App\Controllers\TaskController;
    use App\Controllers\BaseControllers;
    use App\Controllers\CategoryController;
    use App\Controllers\AutheurController;

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/task/{id}', [TaskController::class, 'show']);
    Route::get('/task/{id}/edit', [TaskController::class, 'edit']);
    Route::get('/base', [BaseControllers::class, 'index']);
    #Route::get('/POO/task-manager/public/category', [CategoryController::class, 'index']);
    Route::get('/task/create', [TaskController::class, 'create']);

    Route::get('/autheurs', [AutheurController::class, 'index']);

    Route::post('/task/store', [TaskController::class, 'store']);
    Route::post('/task/{id}', [TaskController::class, 'update']);
    Route::post('/task/{id}/delete', [TaskController::class, 'destroy']);

use App\Controllers\WillController;
Route::get('/Will', [WillController::class, 'index']);
Route::get('/Will/create', [WillController::class, 'create']);
Route::post('/Will/store', [WillController::class, 'store']);
Route::get('/Will/edit/{id}', [WillController::class, 'edit']);
Route::post('/Will/update/{id}', [WillController::class, 'update']);
Route::post('/Will/delete/{id}', [WillController::class, 'destroy']);

use App\Controllers\EtudiantsController;
Route::get('/etudiants', [EtudiantsController::class, 'index']);
Route::get('/etudiants/create', [EtudiantsController::class, 'create']);
Route::post('/etudiants/store', [EtudiantsController::class, 'store']);
Route::get('/etudiants/edit/{id}', [EtudiantsController::class, 'edit']);
Route::post('/etudiants/update/{id}', [EtudiantsController::class, 'update']);
Route::post('/etudiants/delete/{id}', [EtudiantsController::class, 'destroy']);

use App\Controllers\UsersController;
Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/create', [UsersController::class, 'create']);
Route::post('/users/store', [UsersController::class, 'store']);
Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
Route::post('/users/update/{id}', [UsersController::class, 'update']);
Route::post('/users/delete/{id}', [UsersController::class, 'destroy']);
