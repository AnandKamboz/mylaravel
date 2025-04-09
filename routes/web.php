<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;


Route::get('/', function () {
    return view('welcome');
});

// get-members-details
Route::get('/get-members-details',[VerificationController::class,'getMemberDetails'])->name('get-members-details');

