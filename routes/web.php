<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('notes', NoteController::class);
    // Route::get('/notes', [NoteController::class, 'index']);
    // Route::get('/notes/create', [NoteController::class, 'create']);
    // Route::post('/notes', [NoteController::class, 'store']);
    // Route::get('/notes/{note}', [NoteController::class, 'show'] );
    // Route::get('/notes/{note}/edit', [NoteController::class, 'edit']);
    // Route::put('/notes/{note}', [NoteController::class, 'update']);
    // Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
