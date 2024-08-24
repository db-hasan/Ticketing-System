<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\QrcodematchController;



Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'adminlogin'])->name('admin.login');

Route::group(['middleware'=>'isAdmin'],function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');


    Route::get('user-index',[AuthController::class, 'indexuser'])->name('user.index');
    Route::get('user-insert',[AuthController::class,'createuser'])->name('user.create');
    Route::post('user-insert',[AuthController::class,'storeuser'])->name('user.store');
    Route::get('user-update/{id}',[AuthController::class,'edituser'])->name('user.edit');
    Route::put('user-update/{id}',[AuthController::class,'updateuser'])->name('user.update');


    Route::get('role-index',[RoleController::class, 'indexrole'])->name('role.index');
    Route::get('role-insert',[RoleController::class,'createrole'])->name('role.create');
    Route::post('role-insert',[RoleController::class,'storerole'])->name('role.store');
    Route::get('role-update/{id}',[RoleController::class,'editrole'])->name('role.edit');
    Route::put('role-update/{id}',[RoleController::class,'updaterole'])->name('role.update');


    Route::get('profle-update',[AuthController::class,'profileupdate'])->name('profle.update');
    Route::post('profle-update',[AuthController::class,'passwordupdate'])->name('password.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('price-index',[PriceController::class, 'indexprice'])->name('price.index');
    Route::get('price-update/{id}',[PriceController::class,'editprice'])->name('price.edit');
    Route::put('price-update/{id}',[PriceController::class,'updateprice'])->name('price.update');


    Route::get('entry-index',[EntryController::class, 'indexentry'])->name('entry.index');
    Route::get('entry-insert',[EntryController::class,'createentry'])->name('entry.create');
    Route::post('entry-insert',[EntryController::class,'storeentry'])->name('entry.store');
    Route::get('entry-print/{id}',[EntryController::class,'printentry'])->name('entry.print');

    
    Route::get('entrysearch', [EntryController::class, 'entrysearch']);
    Route::get('ridesearch', [TicketController::class, 'ridesearch']);


    Route::get('ride-index',[RideController::class, 'indexride'])->name('ride.index');
    Route::get('ride-insert',[RideController::class,'createride'])->name('ride.create');
    Route::post('ride-insert',[RideController::class,'storeride'])->name('ride.store');
    Route::get('ride-update/{id}',[RideController::class,'editride'])->name('ride.edit');
    Route::put('ride-update/{id}',[RideController::class,'updateride'])->name('ride.update');

    
    Route::get('ticket-index',[TicketController::class, 'indexticket'])->name('ticket.index');
    Route::get('ticket-insert',[TicketController::class,'createticket'])->name('ticket.create');
    Route::post('ticket-insert',[TicketController::class,'storeticket'])->name('ticket.store');
    Route::delete('ticket-destroy/{id}',[TicketController::class,'destroyticket'])->name('ticket.destroy');
    Route::get('ticket-print/{id}',[TicketController::class,'printticket'])->name('ticket.print');


    Route::get('index-report',[ReportController::class, 'indexreport'])->name('report.index');
    Route::post('sales-report',[ReportController::class, 'salesreport'])->name('report.sales');
    Route::get('sales-report',[ReportController::class, 'salesinvoice'])->name('invoice.sales');
    Route::post('seller-report',[ReportController::class, 'sellerreport'])->name('report.seller');                              
    Route::get('seller-report',[ReportController::class, 'sellerinvoice'])->name('invoice.seller'); 
    
    
    Route::get('qrcode-match',[QrcodematchController::class, 'qrcodematch'])->name('qrcode.match');                              
});