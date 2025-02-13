<?php
    use App\Routes\Route;
    use App\Controllers\TaskController;
    use App\Controllers\BaseControllers;
    use App\Controllers\CategoryController;

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/task/{id}', [TaskController::class, 'show']);
    Route::get('/task/{id}/edit', [TaskController::class, 'edit']);
    Route::get('/base', [BaseControllers::class, 'index']);
    #Route::get('/POO/task-manager/public/category', [CategoryController::class, 'index']);
    Route::get('/task/create', [TaskController::class, 'create']);

    Route::post('/task/store', [TaskController::class, 'store']);
    Route::post('/task/{id}', [TaskController::class, 'update']);
    Route::post('/task/{id}/delete', [TaskController::class, 'destroy']);
?>
