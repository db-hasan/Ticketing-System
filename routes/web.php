<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\TicketController;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'adminlogin'])->name('admin.login');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

    Route::get('user-index',[AuthController::class, 'indexuser'])->name('user.index');
    Route::get('user-insert',[AuthController::class,'createuser'])->name('user.create');
    Route::post('user-insert',[AuthController::class,'storeuser'])->name('user.store');
    Route::get('user-update/{id}',[AuthController::class,'edituser'])->name('user.edit');
    Route::put('user-update/{id}',[AuthController::class,'updateuser'])->name('user.update');

    Route::get('profle-update',[AuthController::class,'profileupdate'])->name('profle.update');
    Route::post('profle-update',[AuthController::class,'passwordupdate'])->name('password.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    


    Route::get('ride-index',[RideController::class, 'indexride'])->name('ride.index');
    Route::get('ride-insert',[RideController::class,'createride'])->name('ride.create');
    Route::post('ride-insert',[RideController::class,'storeride'])->name('ride.store');
    Route::get('ride-update/{id}',[RideController::class,'editride'])->name('ride.edit');
    Route::put('ride-update/{id}',[RideController::class,'updateride'])->name('ride.update');

    Route::get('ticket-index',[TicketController::class, 'indexticket'])->name('ticket.index');
    Route::get('ticket-insert',[TicketController::class,'createticket'])->name('ticket.create');
    Route::post('ticket-insert',[TicketController::class,'storeticket'])->name('ticket.store');
    Route::get('ticket-update/{id}',[TicketController::class,'editticket'])->name('ticket.edit');
    Route::put('ticket-update/{id}',[TicketController::class,'updateticket'])->name('ticket.update');
    Route::delete('ticket-destroy/{id}',[TicketController::class,'destroyticket'])->name('ticket.destroy');
});