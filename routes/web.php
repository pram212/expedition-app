<?php

use App\Http\Controllers\API\DatatablesController;
use App\Http\Controllers\CRM\OrderController;
use App\Http\Controllers\CRM\OrderRegisterController;
use App\Http\Controllers\CRM\PaymentController;
use App\Http\Controllers\CRM\RegisterKtpController;
use App\Http\Controllers\CRM\ShipmentController;
use App\Http\Controllers\Reporting\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
    return view('welcome');
});

Auth::routes([
    'register' => false, // Register Routes...

    'reset' => false, // Reset Password Routes...

    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/crm', 'as' => 'crm.', 'middleware' => 'auth'], function () {
    Route::resource('/order', OrderController::class );
    Route::post('/order/delete/multiple', [OrderController::class, 'multiDestroy']);

    Route::group(['prefix' => '/operation', 'as' => 'operation.'], function () {
        Route::resource('/payment', PaymentController::class );
        Route::resource('/shipment', ShipmentController::class );
        Route::post('/shipment/multiupdate', [ShipmentController::class, 'multiUpdate']);
    });

});

Route::group(['prefix' => '/reporting', 'as' => 'reporting.', 'middleware' => 'auth'], function () {
    Route::resource('/', ReportController::class);
});

Route::group(['prefix' => '/datatable', 'as' => 'datatable.', 'middleware' => 'auth'], function () {
    Route::get('/getorder', [DatatablesController::class, 'getOrder'])->name('getorder');
    Route::get('/getorderpayment', [DatatablesController::class, 'getOrderPayment'])->name('getorderpayment');
    Route::get('/getordershipment', [DatatablesController::class, 'getOrderShipment'])->name('getordershipment');
});
    
Route::group(['prefix' => '/pendaftaran', 'as' => 'pendaftaran.'], function () {
    Route::get('/ktp', [OrderRegisterController::class, 'createKtp']);
    Route::post('/ktp', [OrderRegisterController::class, 'storeKtp']);
    Route::get('/kia', [OrderRegisterController::class, 'createKia']);
    Route::post('/kia', [OrderRegisterController::class, 'storeKia']);
    Route::get('/getvillage/{district}', [OrderRegisterController::class, 'getVillage']);
});

