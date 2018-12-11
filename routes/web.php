<?php

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

Route::get('/', function () {    return view('main.login'); });
Route::get('/login', function () {    return view('main.login'); });
Route::post('/login', 'Auth\LoginController@authenticate')->name('main-login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/view_ticket/{ticket_id}', 'Controller@viewTicket')->name('public-view-ticket');

Route::middleware(['auth'])->group(function () {


    Route::prefix('admin')->group( function (){
        
        Route::get('/', 'Admin\Dashboard@index')->name('admin-main');
        Route::get('/ticket/reply/{id}', 'Admin\Dashboard@ticketReplies')->name('admin-ticket-reply');
        Route::post('/ticket/reply/add', 'Admin\Dashboard@addReply')->name('admin-ticket-add-reply');

    });

    Route::prefix('customer')->group( function (){

        Route::get('/', 'Customer\Dashboard@index')->name('customer-main');
        Route::get('/ticket/add', 'Customer\Dashboard@addTicket')->name('customer-ticket-add');
        Route::get('/ticket/close/{ticket_id}', 'Customer\Dashboard@closeTicket')->name('customer-ticket-close');
        Route::post('/ticket/reply/add', 'Customer\Dashboard@addReply')->name('customer-ticket-add-reply');
        Route::get('/ticket/replies/{id}', 'Customer\Dashboard@ticketReplies')->name('customer-ticket-replies');
        Route::post('/ticket/store', 'Customer\Dashboard@createTicket')->name('customer-ticket-store');
        Route::post('/ticket/rate', 'Customer\Dashboard@rateReply')->name('customer-ticket-rate');

    });

});