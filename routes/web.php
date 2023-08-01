<?php

use App\Http\Controllers\APIProcessorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/api-processor', [APIProcessorController::class, 'index'])->name('processor.index');


Route::post('/attempt-url', [APIProcessorController::class, 'getAPI'])->name('processor.getAPI');

