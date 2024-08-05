<?php

use App\Http\Controllers\LuckyDrawController;

Route::get('/lucky-draw', [LuckyDrawController::class, 'showForm']);
Route::post('/lucky-draw', [LuckyDrawController::class, 'addParticipant']);
Route::post('/upload-csv', [LuckyDrawController::class, 'uploadCsv']);
Route::get('/participants', [LuckyDrawController::class, 'showParticipants']);
Route::get('/pick-winner', [LuckyDrawController::class, 'pickWinner']);
