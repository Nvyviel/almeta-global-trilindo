<?php

use App\Models\Shipment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SealController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\StockSealController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ShippingInstructionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// USER
Route::get('/', function () {
    return view('user.index');
})->name('landing-page');
Route::get('/dashboard', function () {
    $shipments = Shipment::all();
    return view('user.dashboard', compact('shipments'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile-edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile-update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile-destroy');
});

require __DIR__ . '/auth.php';

// BACKGROUND COMPANIES
Route::get('/homepage', [ProfileController::class, 'index'])->name('homepage');
Route::get('/service', [ProfileController::class, 'service'])->name('service');

// if user()->is_admin = true
Route::get('/dashboard/admin', [AuthenticatedSessionController::class, 'roomAdmin'])->name('dashboard-admin');
Route::get('detail/user/{id}', [AuthenticatedSessionController::class, 'detail'])->name('detail-user');
Route::post('/dashboard/admin/{user}/is-admin', [AuthenticatedSessionController::class, 'isadmin'])->name('isadmin');

// FILTERING (ALL)
Route::get('/container/ro-filtering', [ContainerController::class, 'filteringRO'])->name('filtering-release-order');
Route::get('/dashboard/shipment/filtering', [ShipmentController::class, 'filtering'])->name('filtering-shipment');

// CONTAINER / RELEASE ORDER
Route::get('/dashboard/release-order', [ContainerController::class, 'releaseOrder'])->name('release-order');
Route::get('/release-order/detail/{id}', [ContainerController::class, 'showDetail'])->name('show-detail');
Route::get('/book/new', [ContainerController::class, 'booking'])->name('booking');
Route::post('/book/new', [ContainerController::class, 'createdata'])->name('bookingprocess');

Route::get('/approval/list', [RegisteredUserController::class, 'approvalList'])->name('approval-list');
Route::get('/dashboard/create/new-ro', [ContainerController::class, 'createNew'])->name('create-new-ro');
Route::get('/approval/release-order', [ShipmentController::class, 'approvalRo'])->name('approval-ro');
Route::post('/containers/{id}/approve', [ShipmentController::class, 'approve'])->name('ro-approved');
Route::post('/containers/{id}/cancel', [ShipmentController::class, 'cancel'])->name('ro-canceled');
Route::get('/history/release-order', [ContainerController::class, 'historyRo'])->name('history-ro');

//SHIPMENT
Route::get('create/shipment', [ShipmentController::class, 'create'])->name('create-shipment');
Route::post('/shipment/create/schedule', [ShipmentController::class, 'addschedule'])->name('addschedule');
Route::get('/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('edit-shipment');
Route::put('/shipments/{shipment}', [ShipmentController::class, 'update'])->name('update-shipment');

// SEAL
Route::get('/approval/seal/add-stock', [SealController::class, 'addStock'])->name('add-stock');
Route::get('/seal', [SealController::class, 'showListSeal'])->name('showListSeal');
Route::get('/seal/list', [SealController::class, 'seal'])->name('seal');
Route::get('/seal/activity', [SealController::class, 'activitySeal'])->name('activity-seal');

// CONSIGNEE
Route::get('/consignee/management', [ConsigneeController::class, 'index'])->name('consignee');
Route::get('/consignees/{consignee}/edit', [ConsigneeController::class, 'edit'])->name('consignee-edit');
Route::put('/consignees/{consignee}', [ConsigneeController::class, 'update'])->name('consignee-update');
Route::delete('/consignees/{consignee}', [ConsigneeController::class, 'destroy'])->name('consignee-destroy');

// SHIPPING INSTRUCTION
Route::get('/shipping-instruction', [ShippingInstructionController::class, 'showList'])->name('shipping-instruction');
Route::get('/shipping-instruction/{container}', [ShippingInstructionController::class, 'showDetail'])->name('shipping-instruction-detail');
Route::get('/dashboard/shipping-instruction/request', [ShippingInstructionController::class, 'requestSi'])->name('request-si');