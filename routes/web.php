<?php

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


Auth::routes();

Route::get('/home',[App\Http\Controllers\AdminController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin' , 'middleware' => 'auth'], function () {


Route::get('export/{status}','BarcodeController@exportExcel')->name('barcodes.export.excel');
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('admin/barcodes/checkbox', [App\Http\Controllers\AdminController::class, 'checkbox'])->name('products.checkbox');
Route::resource('languages', 'LanguageController');
Route::resource('users', 'UserController');
Route::post('exportTracking','AdminController@exportExcel')->name('filter.all.excel');
//Route::post('exportTracking','AdminController@exportExcel')->name('filter.all.excel');
Route::get('print/{shipment}','BarcodeController@printShipment')->name('barcode.print')->middleware('sellerPermissionToPrint');
Route::post('seller_debrief_export','AccountantController@exportSellerDebrief')->name('seller.debrief.excel');
Route::post('courier_debrief_export','AccountantController@exportCourierDebrief')->name('courier.debrief.excel');
Route::put('resetPassword/{user}','UserController@resetPassword')->name('user.reset.password');
Route::get('shipments','BarcodeController@showAllShipments')->name('barcodes.all');

    Route::get('created-shipments','BarcodeController@showCreatedShipments')->name('barcodes.view.created');
    Route::get('pending-shipments','BarcodeController@showPendingShipments')->name('barcodes.view.pending');
Route::get('/invoices','SellerController@invoices')->name('invoices');
    Route::resource('countries', 'CountryController');
Route::post('subArea/store/{area}', 'SubAreaController@store'); // Ajax
Route::get('subArea/edit/{subArea}', 'SubAreaController@edit')->name('edit.sub_area');
Route::put('subArea/update/{subArea}', 'SubAreaController@update')->name('update.sub_area');
Route::resource('barcodes', 'BarcodeController');
Route::post('save-account-info','UserController@saveAccountInfo')->name('save.account.info');

Route::post('/getSellerBackAccount/{seller}','AdminController@getSellerBackAccount'); //ajax
//Route::get('sellerDebrief/inProgress', 'SellerController@inProgress')->name('sellerDebrief.inProgress');
//Route::get('sellerDebrief/finished', 'SellerController@finished')->name('sellerDebrief.finished');
//Route::get('received-orders', 'OperatorController@receivedOrders')->name('operator.received.order');
//Route::get('assign-to-courier', 'OperatorController@assignToCourier')->name('operator.show.assign.to.courier');
//Route::post('assign-to-courier', 'OperatorController@storeAssignedToCourier')->name('operator.store.assign.to.courier');
//Route::post('update-assign-to-courier/{barcode}/{courier}', 'OperatorController@updateAssignedToCourier')->name('update.assign.to.courier');
Route::get('courier', 'CourierController@index')->name('courier.index');
Route::delete('barcode_canceled/{barcode}/{comment}', 'CourierController@cancelledItem')->name('barcode.canceled'); //Ajax
Route::post('barcode_schedule/{barcode}/{note}', 'CourierController@RescheduledItem')->name('barcode.schedule'); //Ajax
//Route::post('barcode_schedule/{barcode}/{date}/{time}/{note}', 'CourierController@RescheduledItem')->name('barcode.schedule'); //Ajax
Route::post('barcode_delivery/{barcode}','CourierController@deliveredItem')->name('barcode.delivery'); // ajax
 //   Route::get('returnedToOperator','OperatorController@returnedToOperator')->name('returned.to.operator'); // ajax
Route::delete('/barcodes/delete', [App\Http\Controllers\BarcodeController::class, 'destroy'])->name('destroy');
//Route::resource('items', 'ItemController');
//Route::post('courierData/{user}','OperatorController@courierData');// Ajax
    Route::get('profile','HomeController@myProfile')->name('my.profile');
    Route::post('changePassword','ProfileController@changeProfilePassword')->name('user.account.change.password');
    Route::post('changeImage','ProfileController@changeProfileImage')->name('user.account.change.image');
// new Routes
    Route::middleware('operator:web')->group(function(){

        Route::get('newOrders','OperatorController@newOrders')->name('operator.new.orders');
        Route::get('ReceiveOrders','OperatorController@showReceiveOrder')->name('show.receive.orders');
        Route::post('CheckItemTrackingNumberForReceiving/{product}','OperatorController@CheckItemTrackingNumberForReceiving')->name('get.data.for.receive');//Ajax
        Route::post('makeAsReceived/{barcodesNo}','OperatorController@makeAsReceived')->name('mark.data.receive');//Ajax
        Route::get('assignToCourier','OperatorController@AssignToCourier')->name('assign.to.courier');
        Route::post('CheckItemTrackingNumberForAssign/{product}','OperatorController@CheckItemTrackingNumberForAssign')->name('check.product.for.assign');//Ajax
        Route::post('assignToUser/{barcodesNo}/{courier}','OperatorController@assignToUser')->name('mark.data.assign');//Ajax
        Route::get('returnToSeller','OperatorController@ReturnToSeller')->name('return.to.seller');
        Route::post('CheckItemTrackingNumberForReturnToSeller/{product}','OperatorController@CheckItemTrackingNumberForReturnToSeller')->name('check.product.for.return');//Ajax
        Route::post('assignToUserToReturn/{barcodesNo}/{courier}','OperatorController@assignToUserToReturnToSeller')->name('return.data.to.seller');//Ajax
        Route::post('assignToUserToReturn/{barcodesNo}/{courier}','OperatorController@assignToUserToReturnToSeller')->name('return.data.to.seller');//Ajax
        Route::get('transfer','OperatorController@Transfer')->name('transfer.orders');
        Route::post('CheckItemTrackingNumberForTransfer/{product}','OperatorController@CheckItemTrackingNumberForTransfer')->name('get.data.for.transfer');//Ajax
        Route::post('getProductInfo/{product}','OperatorController@getProductInfo')->name('get.info.for.product');//Ajax
        Route::post('markAsTransfer/','OperatorController@markAsTransfer')->name('mark.as.transfer');//Ajax
        Route::get('tracking-orders/','OperatorController@showTrackingOrders')->name('tracking.orders');
        Route::get('tracking-orders-no/','OperatorController@showTrackingOrdersByTrackingNumber')->name('tracking.by.tracking.number');
        Route::get('search/','OperatorController@searchItems')->name('tracking.search'); //Ajax
        Route::get('searchByTrackingNumber/','OperatorController@searchByTrackingNumbers')->name('tracking.filter');//Ajax

    });
    Route::middleware(['courier:web'])->group(function(){
        Route::get('courier/{courier}/deliver-items', 'CourierController@showDeliverItems')->name('courier.show.deliver.item');
        Route::get('courier/{courier}/return-items','CourierController@showReturnToSellersItems')->name('courier.show.return.to.sellers.items');
        Route::post('scheduling-seller/{courier}','CourierController@ScheduleToSeller')->name('courier.schedule.to.seller');//ajax
        Route::post('return-to-seller/{courier}','CourierController@ReturnedToSeller')->name('courier.return.to.seller');//ajax
        Route::get('unDebriefed/{courier}','CourierController@ShowUnDebriefed')->name('courier.show.unDebriefed');

    });
    Route::middleware(['operatorOrAccountant:web'])->group(function(){
        Route::post('getAllCreatedShipmentsForThisArea/{area}','OperatorController@getAllCreatedShipmentsForThisArea');
        Route::get('resetStatus/{barcode}','AdminController@resetBarcodeStatus')->name('reset.status');
        Route::get('courier-debrief','AccountantController@courierDebrief')->name('courier.debrief');
        Route::post('courier-debrief/{courier}','AccountantController@getCourierDebrief')->name('courier.debrief.get');//Ajax
        Route::post('end_courier_debrief/{courier}','AccountantController@endCourierDebrief');//Ajax
        Route::get('seller-debrief','AccountantController@sellerDebrief')->name('seller.debrief');
        Route::post('seller-debrief/{seller}','AccountantController@getSellerDebrief')->name('seller.debrief.get');//Ajax
        Route::post('end_seller_debrief/{seller}','AccountantController@endSellerDebrief');//Ajax
        Route::post('getSellerForThisArea/{area}','OperatorController@getAreaSeller')->name('get.area.seller');//Ajax
        Route::post('getSubSellerForThisArea/{subArea}','OperatorController@getSubAreaSeller')->name('get.subarea.seller');//Ajax
        Route::post('getSellerSubAreas/{seller}','OperatorController@getSellerSubAreas')->name('get.seller.subarea');//Ajax
        Route::post('getProductsForSellerInThisArea/{area}/{seller}','OperatorController@getProductsForSeller')->name('get.area.seller');//Ajax
        Route::post('getCouriersForThisArea/{area}','OperatorController@getAreaCouriers')->name('get.area.couriers');//Ajax

    });
    Route::middleware(['seller:web'])->group(function(){
       Route::get('inProgress','SellerController@inProgress')->name('seller.unfinished');
        Route::get('finished','SellerController@finished')->name('seller.finished');
        Route::get('in-progress','BarcodeController@showInProgressShipments')->name('barcodes.view.progress');
    });
});

Route::redirect('/','/admin');


