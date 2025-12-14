<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('todos.index');
})->name('home');

Route::middleware(['auth'])->group(function () {
Route::resource('todos', TodoController::class);

Route::patch('/todos/{todo}/complete', [TodoController::class, 'toggleComplete'])->name('todos.toggle');

Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');

        Route::get('/password', [ProfileController::class, 'editPassword'])->name('edit.password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');

        Route::get('/settings', [ProfileController::class, 'editSettings'])->name('edit.settings');
        Route::put('/settings', [ProfileController::class, 'updatePreferences'])->name('preferences');
    });
});