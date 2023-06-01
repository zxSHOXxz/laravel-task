<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;


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



Route::post('/import', [ImportController::class, 'import'])->name('import');
Route::get('/create', [ImportController::class, 'create'])->name('createImport');
Route::get('/index', [ImportController::class, 'index'])->name('indexImported');

Route::prefix('cms/admin')->group(function () {

    Route::resource('/', DashboardController::class);
    Route::resource('categoaries', CategoryController::class);
});
