<?php

use App\Models\Shipment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\SealController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ShippingInstructionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/auth.php';

Route::middleware('accessable')->group(function () {
    Route::get('/', [ShipmentController::class, 'guestFiltering'])->name('landing-page');
});

Route::middleware(['session', 'status'])->group(function () {
    Route::get('/dashboard', function () {
        $shipments = Shipment::all();
        return view('user.landings.dashboard', compact('shipments'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('/status')->group(function () {
        Route::get('/pending', [RegisteredUserController::class, 'pendingUser'])->name('pending-view');
        Route::post('/user/{id}/update-status', [AuthenticatedSessionController::class, 'updateStatus'])->name('update-status');
        Route::post('/update-document', [AuthenticatedSessionController::class, 'updateDocument'])->name('update-document');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile-edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile-update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile-destroy');
    });

    Route::prefix('/dashboard')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::get('/admin', [AuthenticatedSessionController::class, 'roomAdmin'])->name('dashboard-admin');
            Route::post('/{user}/is-admin', [AuthenticatedSessionController::class, 'isadmin'])->name('isadmin');
        });
    });

    Route::prefix('/create')->group(function () {
        Route::get('/release-order', [ContainerController::class, 'createNew'])->name('create-new-ro');
        Route::get('/shipping-instruction', [ShippingInstructionController::class, 'requestSi'])->name('request-si');
        Route::get('seal', [SealController::class, 'createSeal'])->name('create-seal');
    });

    Route::prefix('/filtering')->group(function () {
        Route::get('/shipment', [ShipmentController::class, 'filtering'])->name('filtering-shipment');
    });

    Route::prefix('/list')->group(function () {
        Route::get('/seal', [SealController::class, 'seal'])->name('seal');
        Route::get('/release-order', [ContainerController::class, 'releaseOrder'])->name('release-order');
        Route::get('/shipping-instruction', [ShippingInstructionController::class, 'showList'])->name('shipping-instruction');
        Route::get('/bills', [BillController::class, 'listBill'])->name('list-bill');
    });

    Route::prefix('/detail')->group(function () {
        Route::get('/release-order/detail/{id}', [ContainerController::class, 'showDetail'])->name('show-detail');
        Route::get('/bills/{bill}', [BillController::class, 'detailBill'])->name('detail-bill');
        Route::get('/shipping-instruction/{container}', [ShippingInstructionController::class, 'showDetail'])->name('shipping-instruction-detail');
    });

    Route::prefix('/book')->group(function () {
        Route::get('/new', [ContainerController::class, 'booking'])->name('booking');
        Route::post('/new', [ContainerController::class, 'createdata'])->name('bookingprocess');
    });

    Route::prefix('/consignee')->group(function () {
        Route::get('/management', [ConsigneeController::class, 'index'])->name('consignee');
        Route::get('/{consignee}/edit', [ConsigneeController::class, 'edit'])->name('consignee-edit');
        Route::put('/{consignee}', [ConsigneeController::class, 'update'])->name('consignee-update');
        Route::delete('/{consignee}', [ConsigneeController::class, 'destroy'])->name('consignee-destroy');
        Route::get('/create', [ConsigneeController::class, 'createConsignee'])->name('create-consignee');
    });



    Route::prefix('/test')->group(function () {
        Route::get('/confirmation-seal/{id}', [SealController::class, 'confirmationSeal'])->name('confirmation-seal');
    });

    Route::prefix('/admin')->group(function () {
        Route::middleware(['admin'])->group(function () {
            Route::prefix('/detail')->group(function () {
                Route::get('/user/{id}', [AuthenticatedSessionController::class, 'detail'])->name('detail-user');
                Route::get('/shipping-instruction/{id}', [ShippingInstructionController::class, 'detailSi'])->name('detail-si');
            });

            Route::prefix('/create')->group(function () {
                Route::get('/shipment', [ShipmentController::class, 'create'])->name('create-shipment');
                Route::get('/bills', [BillController::class, 'createBill'])->name('create-bill');
                Route::post('/shipment/schedule', [ShipmentController::class, 'addschedule'])->name('addschedule');
            });

            Route::prefix('/approval')->group(function () {
                Route::get('/release-order', [ShipmentController::class, 'approvalRo'])->name('approval-ro');
                Route::get('/list', [RegisteredUserController::class, 'approvalList'])->name('approval-list');
                Route::get('/shipping-instruction', [ShippingInstructionController::class, 'approvalSi'])->name('approval-si');
            });

            Route::prefix('/container')->group(function () {
                Route::post('/containers/{id}/approve', [ShipmentController::class, 'approve'])->name('ro-approved');
                Route::post('/containers/{id}/cancel', [ShipmentController::class, 'cancel'])->name('ro-canceled');
            });

            Route::prefix('/history')->group(function () {
                Route::get('/release-order', [ContainerController::class, 'historyRo'])->name('history-ro');
                Route::get('/shipping-instruction', [ShippingInstructionController::class, 'historySi'])->name('history-si');
                // Route::post('/shipping-instruction/{id}/update', [ShippingInstructionController::class, 'updateStatus'])->name('update-status');
                Route::get('/seal', [SealController::class, 'activitySeal'])->name('activity-seal');
            });

            Route::prefix('/shipments')->group(function () {
                Route::get('{shipment}/edit', [ShipmentController::class, 'edit'])->name('edit-shipment');
                Route::put('{shipment}', [ShipmentController::class, 'update'])->name('update-shipment');
            });

            Route::prefix('/upload')->group(function () {
                Route::post('/release-order/{id}', [ShipmentController::class, 'uploadRoPdf'])->name('upload-ro-pdf');
                Route::post('/shipping-instruction/{id}', [ShippingInstructionController::class, 'uploadSiFile'])->name('upload-si-file');
            });

            Route::get('/approvalseal/add-stock', [SealController::class, 'addStock'])->name('add-stock');

            Route::put('/shipping-instruction/{id}/approved', [ShippingInstructionController::class, 'approvedSi'])->name('approved-si');
            Route::put('/shipping-instruction/{id}/rejected', [ShippingInstructionController::class, 'rejectedSi'])->name('rejected-si');
        });
    });
});
