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
    Route::post('/client', [App\Http\Controllers\SalesController::class, 'showclientlist'])->middleware(['auth'])->name('sales.client.list.success');
    Route::get('/client/add', [App\Http\Controllers\SalesController::class, 'addclient'])->middleware(['auth'])->name('sales.client.insert');
    Route::post('/client/add', [App\Http\Controllers\SalesController::class, 'addclient'])->middleware(['auth'])->name('sales.client.insert.suceess');
    Route::get('/client/update/{updateid}', [App\Http\Controllers\SalesController::class, 'updateclient'])->middleware(['auth'])->name('sales.client.update');
    Route::post('/client/update', [App\Http\Controllers\SalesController::class, 'updateclient'])->middleware(['auth'])->name('sales.client.update.suceess');
    Route::get('/client/delete/{deleteid}', [App\Http\Controllers\SalesController::class, 'deleteclient'])->middleware(['auth'])->name('sales.client.delete');

    Route::get('/list', [App\Http\Controllers\SalesController::class, 'newsaleslist'])->middleware(['auth'])->name('sales.new.list');
    Route::post('/list', [App\Http\Controllers\SalesController::class, 'newsaleslist'])->middleware(['auth'])->name('sales.new.list.success');

    Route::get('/add', [App\Http\Controllers\SalesController::class, 'addnewsaleslist'])->middleware(['auth'])->name('sales.new.insert');
    Route::post('/add', [App\Http\Controllers\SalesController::class, 'addnewsaleslist'])->middleware(['auth'])->name('sales.new.insert.suceess');
    Route::get('/update/{updateid}', [App\Http\Controllers\SalesController::class, 'updatenewsaleslist'])->middleware(['auth'])->name('sales.update');
    Route::post('/update', [App\Http\Controllers\SalesController::class, 'updatenewsaleslist'])->middleware(['auth'])->name('sales.update.suceess');
    Route::get('/delete/{deleteid}', [App\Http\Controllers\SalesController::class, 'deletesales'])->middleware(['auth'])->name('sales.delete');
}); 

Route::group(['prefix' => 'upsales'], function(){
    Route::get('/list', [App\Http\Controllers\UpsaleController::class, 'upsalelist'])->middleware(['auth'])->name('upsale.list');
    Route::post('/list', [App\Http\Controllers\UpsaleController::class, 'upsalelist'])->middleware(['auth'])->name('upsale.list.success');

    Route::get('/add', [App\Http\Controllers\UpsaleController::class, 'addupsale'])->middleware(['auth'])->name('upsale.add');
    Route::post('/add', [App\Http\Controllers\UpsaleController::class, 'addupsale'])->middleware(['auth'])->name('upsale.add.success');
    Route::get('/update/{updateid}', [App\Http\Controllers\UpsaleController::class, 'updateupsale'])->middleware(['auth'])->name('upsale.update');
    Route::post('/update', [App\Http\Controllers\UpsaleController::class, 'updateupsale'])->middleware(['auth'])->name('upsale.update.success');
    Route::get('/delete/{deleteid}', [App\Http\Controllers\UpsaleController::class, 'deleteupsale'])->middleware(['auth'])->name('upsale.delete');
    Route::get('/get-project', [App\Http\Controllers\UpsaleController::class, 'getproject'])->middleware(['auth'])->name('upsale.project');
});

Route::group(['prefix' => 'collection'], function(){
    Route::get('/list', [App\Http\Controllers\CollectionController::class, 'collectionlist'])->middleware(['auth'])->name('collection.list');
    Route::post('/list', [App\Http\Controllers\CollectionController::class, 'collectionlist'])->middleware(['auth'])->name('collection.list.success');
    
    Route::get('/add', [App\Http\Controllers\CollectionController::class, 'addcollection'])->middleware(['auth'])->name('collection.add');
    Route::post('/add', [App\Http\Controllers\CollectionController::class, 'addcollection'])->middleware(['auth'])->name('collection.add.success');
    Route::get('/update/{updateid}', [App\Http\Controllers\CollectionController::class, 'updatecollection'])->middleware(['auth'])->name('collection.update');
    Route::post('/update', [App\Http\Controllers\CollectionController::class, 'updatecollection'])->middleware(['auth'])->name('collection.update.success');
    Route::get('/delete/{deleteid}', [App\Http\Controllers\CollectionController::class, 'deletecollection'])->middleware(['auth'])->name('collection.delete');
    Route::get('/get-project', [App\Http\Controllers\UpsaleController::class, 'getproject'])->middleware(['auth'])->name('collection.project');

});