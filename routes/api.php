<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// post
Route::get('/posts', [PostController::class, 'index']) // 一覧
    ->name('posts');
Route::get('/posts/{id}', [PostController::class, 'show']) // 詳細
    ->name('postShow');

// task
Route::get('/tasks', [TaskController::class, 'index']) // 一覧
    ->name('tasks');
Route::post('/tasks', [TaskController::class, 'store']) // 保存
    ->name('taskStore');
Route::get('/tasks/{id}', [TaskController::class, 'show']) // 詳細
    ->name('taskShow');
Route::put('/tasks/{id}', [TaskController::class, 'update']) // 更新
    ->name('taskUpdate');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']) // 削除
    ->name('taskDestroy');

// test
Route::post('/file/upload', [FileController::class, 'upload'])->name('upload');
Route::get('/file/show', [FileController::class, 'show'])->name('show');
// Route::get('/test', [FileController::class, 'test'])->name('test');
