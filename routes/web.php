<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::prefix('game')->group(function () {
    Route::get('/start', [GameController::class, 'startGame'])->name('game.start');
    Route::post('/compare', [GameController::class, 'compareCards'])->name('game.compare');
});
