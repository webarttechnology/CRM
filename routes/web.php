<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\TimeLogController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LogHistoryController;
use App\Http\Controllers\NotificationController;

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
    // $exitCode = Artisan::call('route:cache');
    Artisan::call('optimize');
    dd('clear');
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
    Route::post('/show-module-form', [App\Http\Controllers\AdminController::class, 'show_module_form'])->name('show-module-form');

}); 

Route::get('/forgot-password', [App\Http\Controllers\AdminController::class, 'forgotPassword']);
Route::post('/password/email', [App\Http\Controllers\AdminController::class, 'sendresetLinkemail']);
Route::get('/password/resetdata', [App\Http\Controllers\AdminController::class, 'showResetForm']);  
Route::post('/password/reset', [App\Http\Controllers\AdminController::class, 'resetPassword']);


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
    Route::group(['middleware' => ['auth', 'isSale']], function(){
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

Route::group(['prefix' => 'group', 'middleware' => ['auth', 'isSale']], function () {
        Route::get('/list', [App\Http\Controllers\GroupController::class, 'grouplist'])->name('group.new.list');
        Route::post('/list', [App\Http\Controllers\GroupController::class, 'grouplist'])->name('group.search');
        Route::get('/group-view/{groupid}', [App\Http\Controllers\GroupController::class, 'groupviewById'])->name('group.view');
        Route::post('/add', [App\Http\Controllers\GroupController::class, 'addnewgrouplist'])->name('group.new.insert.suceess');
        Route::get('/update/{updateid}', [App\Http\Controllers\GroupController::class, 'updatenewgrouplist'])->name('group.update');
        Route::post('/update', [App\Http\Controllers\GroupController::class, 'updatenewgrouplist'])->name('group.update.suceess');
        Route::get('/delete/{deleteid}', [App\Http\Controllers\GroupController::class, 'deletegroup'])->name('group.delete');
        Route::get('/invite/{groupid}', [App\Http\Controllers\GroupController::class, 'invite'])->name('group.invite');
        Route::post('/invite', [App\Http\Controllers\GroupController::class, 'invitegroup'])->name('group.new.invite');
        Route::get('/accept-email/{email}/{uniqid}', [App\Http\Controllers\GroupController::class, 'acceptGroup']);
        Route::post('/viewMember', [App\Http\Controllers\GroupController::class, 'member'])->name('group.viewmember');
        Route::get('/view-member/{groupid}', [App\Http\Controllers\GroupController::class, 'allGroupMember'])->name('group.viewmembers');
        Route::get('/memberdelete/{groupmemberid}', [App\Http\Controllers\GroupController::class, 'deleteMember'])->name('group.memberdelete');
});

Route::get('/register/{email}/{uniqid}', [App\Http\Controllers\GroupController::class, 'userRegister']);
Route::post('/userRegister', [App\Http\Controllers\GroupController::class, 'saveUser']);


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
    ->middleware('auth')
    ->group(function () {

        Route::get('', 'index')->name('user.index');
        Route::post('', 'index')->name('user.search');
        Route::get('/add', 'add')->name('user.add');
        Route::post('/add', 'add')->name('user.add.success');
        Route::get('/update/{updateid}', 'update')->name('user.update');
        Route::post('/update', 'update')->name('user.update.success');
        Route::get('/delete/{deleteid}', 'delete')->name('user.delete');
        Route::get('/time-log/{id}', 'time_log');
        
});

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
        Route::post('upload-file-comment', 'upload_file_comment')->name('upload-file-comment');
        Route::post('download-file', 'download_file');

})->middleware(['auth']);



Route::post("/clockin-break-clockout", [TimeLogController::class, 'clockin_break_clockout'])->middleware(['auth']);
Route::post("/clockin-break-clockout-time", [TimeLogController::class, 'clockin_break_clockout_time'])->middleware(['auth']);
Route::post("/check-previous-clockout", [TimeLogController::class, 'check_previous_clockout'])->middleware(['auth']);
Route::post("/previous-clockout-time-submit", [TimeLogController::class, 'previous_clockout_time_submit'])->name('previous-clockout-time-submit')->middleware(['auth']);
Route::get("/check-user-auth", [TimeLogController::class, 'check_user_auth']);


Route::controller(DeveloperController::class)
 ->prefix('developer')
 ->middleware('auth')
 ->group(function () {
    Route::get('task','task' )->name("developer.task");
    Route::post('task', 'task')->name("developer.task.success");
    Route::post('task/update', 'edit')->name("developer.task.edit");
    Route::get('task/delete', 'delete')->name("developer.task.delete");
    Route::get('task/show/{id}', 'show')->name("developer.task.show");
    Route::post('get-assign-to', 'get_assign_to')->name("developer.get-assign-to");
    Route::get('time-log', 'time_log');
});

Route::controller(App\Http\Controllers\WorkhistoryController::class)
 ->prefix('workhistory')
    ->group(function () {

        Route::get('','create' )->name("workhistory.create");
        Route::post('get-total-workhistory-per-task', 'get_total_workhistory_per_task' );
        Route::post('store-total-workhistory-per-task', 'store_total_workhistory_per_task' );
        Route::post('get-status-work-history', 'get_status_work_history' )->name("get-status-work-history");
        Route::post('store-status-page-refresh', 'store_status_page_refresh' )->name("store-status-page-refresh");
        Route::post('current-task-timer-get', 'current_task_timer_get' )->name("current-task-timer-get");
        Route::post('get-task-list', 'get_task_list' );

})->middleware(['auth']);


Route::controller(LogHistoryController::class)
 ->prefix('log')
 ->group(function () {
    Route::get('history', 'index' )->name("log.history");
    Route::get('details/{id}', 'details' )->name("log.details");
})->middleware(['auth']);


Route::post("/show-chat-module", [AdminController::class, 'show_chat_module'])->name('show-chat-module');
Route::post("/chat/download-file", [AdminController::class, 'download_chatfile']);

Route::post("/notifications/mark-all-as-read", [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead')->middleware(['auth']);
Route::get('/get-notification',[NotificationController::class, 'getNotification'])->middleware(['auth']);
Route::get('/getUnreadNotificationCount',[NotificationController::class, 'getUnreadNotificationCount'])->middleware(['auth']);
Route::get('/get-allnotification',[NotificationController::class, 'getAllNotification'])->middleware(['auth']);



