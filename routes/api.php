<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;

Route::prefix('/')->middleware('auth:sanctum')->group(function () {
    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register')->withoutMiddleware('auth:sanctum');
        Route::post('/login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth:sanctum');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('/note')->name('notes.')->group(function () {
        Route::get('/', [NoteController::class, 'index'])->name('index');
        Route::post('/', [NoteController::class, 'store'])->name('store');
        Route::get('/{id}', [NoteController::class, 'show'])->name('show');
        Route::put('/{id}', [NoteController::class, 'update'])->name('update');
        Route::delete('/{id}', [NoteController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/restore', [NoteController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [NoteController::class, 'forceDelete'])->name('force-delete');
        Route::patch('/{id}/archive', [NoteController::class, 'archive'])->name('archive');
        Route::patch('/{id}/unarchive', [NoteController::class, 'unArchive'])->name('unarchive');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});


