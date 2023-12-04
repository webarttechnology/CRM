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

Route::get('/demo', function () {
    // return view('welcome');
    
    // $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('optimize');
    dd('clear');
        
    dd("digital webber");
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

Route::get("/dashboard", [App\Http\Controllers\AdminController::class, 'dashboard'])->middleware(['auth'])->name("admin.dashboard");

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function(){    
    Route::get('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('user.profile.success');

    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
}); 

Route::group(['prefix' => 'sales'], function(){
    // Access only for admin, Account manager & sales team.
    Route::group(['middleware'=>['auth', 'isSale']], function(){
        Route::get('/client', [App\Http\Controllers\SalesController::class, 'showclientlist'])->name('sales.client.list');
        Route::post('/client', [App\Http\Controllers\SalesController::class, 'showclientlist'])->name('sales.client.list.success');
        Route::get('/client/add', [App\Http\Controllers\SalesController::class, 'addclient'])->name('sales.client.insert');
        Route::post('/client/add', [App\Http\Controllers\SalesController::class, 'addclient'])->name('sales.client.insert.suceess');
        Route::get('/client/update/{updateid}', [App\Http\Controllers\SalesController::class, 'updateclient'])->name('sales.client.update');
        Route::post('/client/update', [App\Http\Controllers\SalesController::class, 'updateclient'])->name('sales.client.update.suceess');
        Route::get('/list', [App\Http\Controllers\SalesController::class, 'newsaleslist'])->name('sales.new.list');
        Route::post('/list', [App\Http\Controllers\SalesController::class, 'newsaleslist'])->name('sales.new.list.success');
    });

    // Access only for admin
    Route::group(['middleware' => ['auth', 'isAdmin']], function(){
        Route::get('/client/delete/{deleteid}', [App\Http\Controllers\SalesController::class, 'deleteclient'])->name('sales.client.delete');
    });

    // Access only for admin, Account manager.  

    Route::group(['middleware' => ['auth', 'isAdmin']], function(){
        Route::get('/assgin/{taskid}', [App\Http\Controllers\SalesController::class, 'assign'])->name('sales.assign');
        Route::post('/assgin', [App\Http\Controllers\SalesController::class, 'assign'])->name('sales.assign.success');
    
    });  

    
    Route::get('/add', [App\Http\Controllers\SalesController::class, 'addnewsaleslist'])->middleware(['auth'])->name('sales.new.insert');
    Route::post('/add', [App\Http\Controllers\SalesController::class, 'addnewsaleslist'])->middleware(['auth'])->name('sales.new.insert.suceess');
    Route::get('/sales-view/{salesid}', [App\Http\Controllers\SalesController::class, 'salesviewById'])->middleware(['auth'])->name('sales.view');
    
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

Route::group(['prefix' => 'renewal'], function(){
    Route::get("/list", [App\Http\Controllers\RenewalController::class, 'domainrenewallist']) ->middleware(['auth'])->name('domain.renewal.list');

});

Route::controller(App\Http\Controllers\UserController::class)
    ->prefix('employee')
    ->group(function () {
        Route::get('', 'index')->name('user.index');
        Route::post('', 'index')->name('user.search');
        Route::get('/add', 'add')->name('user.add');
        Route::post('/add', 'add')->name('user.add.success');
        Route::get('/update/{updateid}', 'update')->name('user.update');
        Route::post('/update', 'update')->name('user.update.success');
        Route::get('/delete/{deleteid}', 'delete')->name('user.delete');
})->middleware(['auth']);

Route::controller(App\Http\Controllers\TaskController::class)
    ->prefix('task')
    ->group(function () {
        Route::get('', 'index')->name('task.index');
        Route::get('/add', 'add')->name('task.add');
        Route::post('/add', 'add')->name('task.add.success');
        Route::get('/update/{updateid}', 'update')->name('task.update');
        Route::post('/update', 'update')->name('task.update.success');
        Route::get('/delete/{deleteid}', 'delete')->name('task.delete');
})->middleware(['auth']);

Route::controller(App\Http\Controllers\CommentController::class)
    ->prefix('comment')
    ->group(function () {
        Route::get('/list/{taskid}', 'index')->name('comment.index');
        Route::get('/message', 'getMessage')->name('comment.list');
        Route::get('/add', 'index')->name('comment.add.success');
})->middleware(['auth']);


Route::controller(App\Http\Controllers\DeveloperController::class)
 ->prefix('developer')
    ->group(function () {
        Route::get('task','task' )->name("developer.task");
        Route::post('task', 'task')->name("developer.task.success");
        Route::post('task/update', 'edit')->name("developer.task.edit");
        Route::get('task/delete', 'delete')->name("developer.task.delete");
        Route::get('task/show/{id}', 'show')->name("developer.task.show");
})->middleware(['auth']);

Route::controller(App\Http\Controllers\WorkhistoryController::class)
 ->prefix('workhistory')
    ->group(function () {
        Route::get('','create' )->name("workhistory.create");
})->middleware(['auth']);