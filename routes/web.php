<?php
use App\Http\Controllers\Admin\AssignWorkerController;
Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::redirect('/', '/login')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // items
    Route::delete('items/destroy', 'ItemsController@massDestroy')->name('items.massDestroy');
    Route::resource('items', 'ItemsController');
    Route::post('items/category', 'ItemsController@category')->name('items.category');

     // Vendor
     Route::delete('vendor/destroy', 'VendorController@massDestroy')->name('vendor.massDestroy');
     Route::resource('vendor', 'VendorController');

     // Issue Record
     Route::delete('issue_record/destroy', 'IssueRecordController@massDestroy')->name('issue_record.massDestroy');
     Route::resource('issue_record', 'IssueRecordController');

     // Assign Worker
     Route::delete('assign_worker/destroy', 'AssignWorkerController@massDestroy')->name('assign_worker.massDestroy');
     Route::resource('assign_worker', 'AssignWorkerController');
    //  Route::get('assign_worker/assignWorker', 'AssignWorkerController@assignWorker')->name('admin.assign_worker.assignWorker');


    //  assign_worker_access
     // Worker
     Route::delete('worker/destroy', 'WorkerController@massDestroy')->name('worker.massDestroy');
     Route::resource('worker', 'WorkerController');
     Route::post('worker/bulk_upload', 'WorkerController@bulkUpload')->name('worker.bulkUpload');
     Route::get('/download-csv-template', 'WorkerController@downloadCsvTemplate')->name('download.csv.template');
    Route::get('/search-workers', 'WorkerController@searchWorkers')->name('search_workers');




    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Stocks
    //Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');
    Route::resource('stocks', 'StocksController')->only(['index', 'show']);

    // Transactions
//    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::post('transactions/{stock}/storeStock', 'TransactionsController@storeStock')->name('transactions.storeStock');
    Route::resource('transactions', 'TransactionsController')->only(['index']);

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});

Route::get('/nfc/{nfc_serial_number}', 'NfcController@show')->name('nfc.show');
Route::get('/assign/worker/{nfc_serial_number}', 'NfcController@assignWorker')->name('assign.worker');


Route::post('/nfc/{nfc_serial_number}', 'NfcController@assignToWorker')->name('nfc.assignToWorker');
Route::get('assign_worker/workers', [AssignWorkerController::class, 'getWorkers'])->name('admin.workers.getWorkers');
Route::post('assign_worker/assignItem/{nfc_serial_number}', [AssignWorkerController::class, 'assignItem'])->name('admin.assign_worker.assignItem');
// routes/web.php

Route::get('workers/details-by-gate-pass-number', [AssignWorkerController::class,'getWorkerDetailsByGatePassNumber'])->name('admin.workers.getWorkerDetailsByGatePassNumber');
Route::get('/search-workers', 'WorkerController@searchWorkers')->name('search_workers');
