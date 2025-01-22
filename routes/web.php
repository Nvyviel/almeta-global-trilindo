<?php

use App\Models\Shipment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SealController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ShippingInstructionController;

Route::get('/', function () {
    return view('user.index');
})->name('login');

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

// UPDATE AS ADMINS
Route::post('/dashboard/admin/{user}/is-admin', [AuthenticatedSessionController::class, 'isadmin'])->name('isadmin');

// USERS (DASHBOARD)
Route::get('/homepage', [ProfileController::class, 'index'])->name('homepage');
Route::get('/service', [ProfileController::class, 'service'])->name('service');
// Route::post('/login', [RegisteredUserController::class, 'store'])->name('login');
// CONTAINERS (DASHBOARD)
Route::get('/book/new', [ContainerController::class, 'booking'])->name('booking');
Route::post('/book/new', [ContainerController::class, 'createdata'])->name('bookingprocess');
// FILTERING DATA SHIPMENT (DASHBOARD)
Route::get('/dashboard/shipment/filtering', [ShipmentController::class, 'filtering'])->name('filtering-shipment');
// RELEASE ORDER (DASHBOARD)
Route::get('/dashboard/release-order', [ContainerController::class, 'releaseOrder'])->name('release-order');
// SHOW DETAIL CONTAINER (DASHBOARD)
Route::get('/release-order/detail/{id}', [ContainerController::class, 'showDetail'])->name('show-detail');
// SEAL (DASHBOARD)
Route::get('/seal/list', [SealController::class, 'seal'])->name('seal');
// SHOW LIST SEAL (DASHBOARD)
Route::get('/seal', [SealController::class, 'showListSeal'])->name('showListSeal');

// DELETE DATA CONTAINER (DUMMY)
Route::get('/delete-data/{id}', [ContainerController::class, 'destroy'])->name('deletedata');

// ADD DATA SHIPMENT (ADMIN-DASHBOARD)
Route::post('/shipment/create/schedule', [ShipmentController::class, 'addschedule'])->name('addschedule');
// EDIT DATA SHIPMENT (ADMIN-DASHBOARD)
Route::get('/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('edit-shipment');
Route::put('/shipments/{shipment}', [ShipmentController::class, 'update'])->name('update-shipment');
// APPROVAL LIST (ADMIN-DASHBOARD)
Route::get('/approval/list', [RegisteredUserController::class, 'approvalList'])->name('approval-list');
// APPROVAL CONTAINER DATA (ADMIN-DASHBOARD)
Route::get('/approval/release-order', [ShipmentController::class, 'approvalRo'])->name('approval-ro');
// APPROVAL CONTAINER DATA TO RO (ADMIN-DASHBOARD)
Route::post('/containers/{id}/approve', [ShipmentController::class, 'approve'])->name('ro-approved');
Route::post('/containers/{id}/cancel', [ShipmentController::class, 'cancel'])->name('ro-canceled');
// FILTERING DATA RELEASE ORDER (ADMIN-DASHBOARD)
Route::get('/container/ro-filtering', [ContainerController::class, 'filteringRO'])->name('filtering-release-order');
// PAGE FOR CREATE SHIPMENT (ADMIN-DASHBOARD)
Route::get('create/shipment', [ShipmentController::class, 'create'])->name('create-shipment');
// PAGE FOR ADD STOCK SEAL (ADMIN-DASHBOARD)
Route::get('/approval/seal/add-stock', [SealController::class, 'addStock'])->name('add-stock');


// CREATE SHIPMENT (LIVEWIRE)
Route::get('/dashboard/admin', [AuthenticatedSessionController::class, 'roomAdmin'])->name('dashboard-admin');

// CREATE CONTAINER (LIVEWIRE)
Route::get('/dashboard/create/new-ro', [ContainerController::class, 'createNew'])->name('create-new-ro');


// CONSIGNEE
Route::get('/consignee/management', [ConsigneeController::class, 'index'])->name('consignee');
Route::get('/consignees/{consignee}/edit', [ConsigneeController::class, 'edit'])->name('consignee-edit');
Route::put('/consignees/{consignee}', [ConsigneeController::class, 'update'])->name('consignee-update');
Route::delete('/consignees/{consignee}', [ConsigneeController::class, 'destroy'])->name('consignee-destroy');

// HISTORY
Route::get('/history/release-order', [ContainerController::class, 'historyRo'])->name('history-ro');

// SHIPPING INSTRUCTION
Route::get('/dashboard/shipping-instruction', [ShippingInstructionController::class, 'showList'])->name('shipping-instruction');