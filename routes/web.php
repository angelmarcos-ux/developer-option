<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // List Of Names
    Route::delete('list-of-names/destroy', 'ListOfNamesController@massDestroy')->name('list-of-names.massDestroy');
    Route::resource('list-of-names', 'ListOfNamesController');

    // Locals
    Route::delete('locals/destroy', 'LocalsController@massDestroy')->name('locals.massDestroy');
    Route::resource('locals', 'LocalsController');

    // Report
    Route::delete('reports/destroy', 'ReportController@massDestroy')->name('reports.massDestroy');
    Route::resource('reports', 'ReportController');

    // Message
    Route::delete('messages/destroy', 'MessageController@massDestroy')->name('messages.massDestroy');
    Route::post('messages/media', 'MessageController@storeMedia')->name('messages.storeMedia');
    Route::post('messages/ckmedia', 'MessageController@storeCKEditorImages')->name('messages.storeCKEditorImages');
    Route::resource('messages', 'MessageController');

    // Audit
    Route::delete('audits/destroy', 'AuditController@massDestroy')->name('audits.massDestroy');
    Route::resource('audits', 'AuditController');

    // Information Reports
    Route::delete('information-reports/destroy', 'InformationReportsController@massDestroy')->name('information-reports.massDestroy');
    Route::resource('information-reports', 'InformationReportsController');

    // Memo Report
    Route::delete('memo-reports/destroy', 'MemoReportController@massDestroy')->name('memo-reports.massDestroy');
    Route::post('memo-reports/media', 'MemoReportController@storeMedia')->name('memo-reports.storeMedia');
    Route::post('memo-reports/ckmedia', 'MemoReportController@storeCKEditorImages')->name('memo-reports.storeCKEditorImages');
    Route::resource('memo-reports', 'MemoReportController');

    // Invoice
    Route::delete('invoices/destroy', 'InvoiceController@massDestroy')->name('invoices.massDestroy');
    Route::resource('invoices', 'InvoiceController');



    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::post('get/latest/invoice/date', 'Admin\InvoiceController@getinoiceWithDate')->name('getinoiceWithDate');
Route::post('get/latest/report/date', 'Admin\ReportController@getinoiceWithDatereport')->name('getinoiceWithDatereport');
Route::post('get/latest/audit/date', 'Admin\AuditController@invoiceAudit')->name('invoiceAudit');
Route::post('get/client/details/date', 'Admin\ReportController@getDatailsClient')->name('getDatailsClient');


Route::post('clinet/modify/save', 'Admin\ListOfNamesController@store')->name('clientsave');
Route::post('clinet/modify/satus', 'Admin\ListOfNamesController@StatusSave')->name('StatusSave');
Route::get('clinet/modify/ledger', 'Admin\ListOfNamesController@ledger')->name('ledger');
Route::post('clinet/modify/ledger_ajax', 'Admin\ListOfNamesController@ledger_ajax')->name('ledger_ajax');
Route::post('clinet/modify/get/customer', 'Admin\ListOfNamesController@get_customer')->name('get_customer');

Route::post('get/latest/invoice', 'Admin\InvoiceController@getInvoiceLAtest')->name('getInvoiceLAtest');
Route::post('invoice/modify/save', 'Admin\InvoiceController@store')->name('invoicesave');
Route::get('invoice/modify/print', 'Admin\InvoiceController@print')->name('printInvoice');
Route::post('invoice/latest/get/print', 'Admin\InvoiceController@getAtleastFourLAstbill')->name('getAtleastFourLAstbill');
Route::post('invoice/latest/get/plusone', 'Admin\InvoiceController@getInvoiceLAtest_plusOne')->name('getInvoiceLAtest_plusOne');
Route::post('invoice/latest/get/get_price', 'Admin\InvoiceController@get_price')->name('get_price');
Route::post('invoice/latest/get/latest_four', 'Admin\InvoiceController@latest_four')->name('latest_four');
Route::get('invoice/latest/get/price', 'Admin\InvoiceController@price')->name('price');
Route::get('invoice/latest/edit/price', 'Admin\InvoiceController@price_edit')->name('price_edit');
Route::post('invoice/latest/price_save/price', 'Admin\InvoiceController@price_save')->name('price_save');
Route::post('invoice/latest/destroy_price/price', 'Admin\InvoiceController@destroy_price')->name('destroy_price');
Route::get('invoice/latest/create_price/price', 'Admin\InvoiceController@create_price')->name('create_price');

Route::get('audits/log/accept', 'Admin\AuditController@audit')->name('auditLogs');
