<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('cms.dashboard.index');
});


Route::post('/import', [ImportController::class, 'import'])->name('import');
Route::get('/create', [ImportController::class, 'create'])->name('createImport');

Route::prefix('cms/admin')->group(function () {

    Route::resource('categoaries', CategoryController::class);
});
