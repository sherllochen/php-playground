<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotionController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::redirect('/', '/blog');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/notion', [NotionController::class, 'show']);

Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index']);
Route::get('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'show']);
