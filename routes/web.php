<?php

use App\Http\Controllers\ImportController;
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

Route::prefix('/import')->name('import.')->group(function () {
    Route::get('/', [ImportController::class, 'index'])->name('index');
    Route::post('/start', [ImportController::class, 'start'])->name('start');
    Route::get('/edit/{document}', [ImportController::class, 'edit'])->name('edit');
    Route::patch('/update/{document}', [ImportController::class, 'update'])->name('update');
    Route::delete('/delete/{document}', [ImportController::class, 'delete'])->name('delete');
});