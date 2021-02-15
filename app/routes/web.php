<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/users/list', 301);

Route::prefix('users')->group(function() {
    Route::get('/list', [UserController::class, 'index'])->name('users');

    Route::get('/', [UserController::class, 'new'])->name('new.user');
    Route::post('/', [UserController::class, 'store'])->name('store.user');
    Route::delete('/', [UserController::class, 'delete'])->name('edit.del');

    Route::get('/{id}', [UserController::class, 'view'])->name('edit.user');
    Route::put('/{id}', [UserController::class, 'update'])->name('save.user');
});
