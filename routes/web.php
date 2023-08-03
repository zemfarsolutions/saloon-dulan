<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\ReceptionistHomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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
    return view('admin.login');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Application cache cleared';
})->name('clear-cache');

Route::as('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');
    Route::get('admin/signin', [AuthController::class, 'get_login'])->name('signin');
    Route::post('admin/signin', [AuthController::class, 'login'])->name('signin');
    Route::get('signup', [AuthController::class, 'singup'])->name('singup');
    Route::post('signup', [AuthController::class, 'singup'])->name('singup');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::get('/admin/users', [AdminHomeController::class, 'getUserList'])->name('users');
    Route::get('/admin/users/add', [AdminHomeController::class, 'createUser'])->name('users.add');
    Route::post('/admin/users/add', [AdminHomeController::class, 'addUser'])->name('users.add');
    Route::get('/admin/users/edit/{user}', [AdminHomeController::class, 'updateUser'])->name('users.edit');
    Route::post('/admin/users/edit/{user}', [AdminHomeController::class, 'editUser'])->name('users.edit');
    Route::post('/admin/users/delete/{user}', [AdminHomeController::class, 'deleteUser'])->name('users.delete');

    Route::get('/admin/hairdresser', [AdminHomeController::class, 'getHairdreseerList'])->name('hairdresser');
    Route::get('/admin/hairdresser/add', [AdminHomeController::class, 'createHairDresser'])->name('hairdresser.add');
    Route::post('/admin/hairdresser/add', [AdminHomeController::class, 'addHairDresser'])->name('hairdresser.add');
    Route::get('/admin/hairdresser/edit/{user}', [AdminHomeController::class, 'editHairDresser'])->name('hairdresser.edit');
    Route::put('/admin/hairdresser/edit/{user}', [AdminHomeController::class, 'UpdateHairDresser'])->name('hairdresser.edit');
    Route::post('/admin/hairdresser/delete/{user}', [AdminHomeController::class, 'deleteHairDresser'])->name('hairdresser.delete');
    Route::get('/admin/promotion/delete/{user}', [AdminHomeController::class, 'deletePromotion'])->name('promotion.delete');
    Route::get('/admin/appointments/delete/{user}/{ticket}', [AdminHomeController::class, 'deleteAppointments'])->name('appointments.delete');

    Route::post('/admin/report', [AdminHomeController::class, 'getAllTickets'])->name('report.post');
    Route::get('/admin/report', [AdminHomeController::class, 'getReport'])->name('report.get');
    Route::post('/admin/sessions', [AdminHomeController::class, 'startEndSession'])->name('admin.session');

    //ajax calling
    Route::get('/admin/getDesk', [AdminHomeController::class, 'getDesk'])->name('getDesk');


    Route::get('/admin/sections', [AdminHomeController::class, 'sectionList'])->name('sections');
    Route::get('/admin/sections/add', [AdminHomeController::class, 'createSections'])->name('sections.add');
    Route::post('/admin/sections/add', [AdminHomeController::class, 'addSections'])->name('sections.add');
    Route::get('/admin/sections/edit/{sections}', [AdminHomeController::class, 'editSections'])->name('sections.edit');
    Route::put('/admin/sections/edit/{sections}', [AdminHomeController::class, 'updateSection'])->name('sections.edit');
    Route::post('/admin/sections/delete/{sections}', [AdminHomeController::class, 'updateSections'])->name('sections.delete');

    Route::get('/admin/roles', [AdminHomeController::class, 'roleList'])->name('roles');
    Route::get('/admin/roles/add', [AdminHomeController::class, 'createRole'])->name('roles.add');
    Route::post('/admin/roles/add', [AdminHomeController::class, 'addRole'])->name('roles.add');
    Route::get('/admin/roles/edit/{userrole}', [AdminHomeController::class, 'editRole'])->name('roles.edit');
    Route::put('/admin/roles/edit/{userrole}', [AdminHomeController::class, 'updateRole'])->name('roles.edit');

    Route::get('/admin/tickets', [TicketController::class, 'getAllTickets'])->name('tickets');
    Route::post('/admin/tickets/detail', [TicketController::class, 'PrintTicket'])->name('tickets.detail');

    Route::get('/admin/settings', [AdminHomeController::class, 'settings'])->name('settings');
    Route::post('/admin/settings/edit', [AdminHomeController::class, 'updatesettings'])->name('settings.edit');

    //promotion
    Route::get('/admin/promotion/list', [AdminHomeController::class, 'promotionList'])->name('promotion');
    Route::get('/admin/promotion/add', [AdminHomeController::class, 'addPromotion'])->name('promotion.add');
    Route::post('/admin/promotion/add', [AdminHomeController::class, 'createPromotion'])->name('promotion.add');

    Route::get('/admin/appointments', [AdminHomeController::class, 'appointmentList'])->name('appointments');
    Route::get('/admin/appointments/add', [AdminHomeController::class, 'addAppointment'])->name('appointments.add');
    Route::post('/admin/appointments/add', [AdminHomeController::class, 'createAppointment'])->name('appointments.add');
    Route::get('/admin/appointments/edit/{appointment}', [AdminHomeController::class, 'editAppoint'])->name('appointments.edit');
    Route::put('/admin/appointments/edit/{appointment}', [AdminHomeController::class, 'updateAppointment'])->name('appointments.edit');

    Route::get('/admin/tickets', [AdminHomeController::class, 'ticketsList'])->name('tickets');
});

Route::get('/', [ReceptionistHomeController::class, 'index'])->name('ticket-dashboard');
Route::post('generate', [TicketController::class, 'CreateTicket'])->name('ticket.add');
Route::post('tserve/{ticket}', [UserController::class, 'startServe'])->name('ticket.serve');
Route::post('tserved/{ticket}', [UserController::class, 'startServed'])->name('ticket.served');
Route::post('tdiscard/{ticket}', [AdminHomeController::class, 'discard'])->name('ticket.discard');
Route::get('udashboard', [UserController::class, 'index'])->name('userdashboard');
Route::post('update_station', [AdminHomeController::class, 'updatestatus'])->name('updatestation');
Route::post('getuserticket', [UserController::class, 'getTicketsByHair'])->name('getuserticket');
Route::get('getudashboard', [UserController::class, 'getTicketsDashboard'])->name('ddashboard');
Route::get('getudashboard3', [UserController::class, 'getTicketsDashboard3'])->name('ddashboard3');

Route::post('store_notification', [UserController::class, 'store'])->name('storeNotification');

Route::post('tserving/{ticket}', [TicketController::class, 'StartTicketServingTimee'])->name('ticket.serving');
Route::post('tserveded/{ticket}', [TicketController::class, 'EndTicketServingTimee'])->name('ticket.serveded');
Route::post('tdiscarded/{ticket}', [TicketController::class, 'DiscardTickete'])->name('ticket.discarded');