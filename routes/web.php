<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('tickets', TicketController::class);
    Route::get('tickets/{ticket}/open',[TicketController::class,'open'])->name('tickets.open');
    Route::get('tickets/{ticket}/close',[TicketController::class,'close'])->name('tickets.close');
    Route::resource('roles', RoleController::class);

});


require __DIR__.'/auth.php';
