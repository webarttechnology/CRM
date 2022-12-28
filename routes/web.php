<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get("/dashboard", [App\Http\Controllers\AdminController::class, 'dashboard'])->middleware(['auth'])->name("admin.dashboard");

Route::group(['prefix' => 'admin'], function(){    
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->middleware(['auth'])->name('admin.logout');
}); 

Route::group(['prefix' => 'sales'], function(){    
    Route::get('/client', [App\Http\Controllers\SalesController::class, 'showclientlist'])->middleware(['auth'])->name('sales.client.list');
    Route::get('/client/add', [App\Http\Controllers\SalesController::class, 'addclient'])->middleware(['auth'])->name('sales.client.insert');
    Route::post('/client/add', [App\Http\Controllers\SalesController::class, 'addclient'])->middleware(['auth'])->name('sales.client.insert.suceess');
}); 