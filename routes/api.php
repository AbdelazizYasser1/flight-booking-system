<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, 
    AirlineController, 
    AirportController, 
    FacilityController,
    FlightClassController, 
    FlightController, 
    FlightSeatController,
    FlightSegmentController, 
    PromoCodeController, 
    TransactionController, 
    TransactionPassengerController
};

Route::post('/register', [AuthController::class, 'register'])->name('register');   //Done 
Route::post('/login', [AuthController::class, 'login'])->name('login');         //Done       

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user-profile', [AuthController::class, 'userProfile']);        //Done     
    Route::post('/logout', [AuthController::class, 'logout']);                  //Done    

    Route::get('/airports', [AirportController::class, 'index']);               //Done   
    Route::get('/airports/{name}', [AirportController::class, 'show']);         //Done
    Route::get('/airlines', [AirlineController::class, 'index']);               //Done
    Route::get('/airlines/{name}', [AirlineController::class, 'show']);         //Done  

    Route::get('/flights', [FlightController::class, 'index']);                 //Done         
    Route::get('/flights/{flight_number}', [FlightController::class, 'show']);         //Done
    Route::get('/flight-classes', [FlightClassController::class, 'index']);     //Done
    Route::get('/flight-seats', [FlightSeatController::class, 'index']);        //Done
    Route::get('/flight-segments', [FlightSegmentController::class, 'index']);  //Done

    Route::get('/promo-codes', [PromoCodeController::class, 'index']);          //Done
    Route::get('/promo-codes/{code}', [PromoCodeController::class, 'show']);    //Done
    Route::get('/validate-promo/{code}', [PromoCodeController::class, 'validatePromoCode']); //Done

    Route::get('/facilities', [FacilityController::class, 'index']);            //Done
    Route::get('/facilities/{name}', [FacilityController::class, 'show']);      //Done

    Route::middleware('admin')->group(function () {
        Route::apiResource('facilities', FacilityController::class)->except(['index', 'show']); //Done
        Route::apiResource('airports', AirportController::class)->except(['index', 'show']);    //Done
        Route::apiResource('airlines', AirlineController::class)->except(['index', 'show']);    //Done
        Route::apiResource('flights', FlightController::class)->except(['index', 'show']);      //Done
        Route::apiResource('flight-classes', FlightClassController::class)->except(['index']);  //Done
        Route::apiResource('flight-seats', FlightSeatController::class)->except(['index']);     //Done
        Route::apiResource('flight-segments', FlightSegmentController::class)->except(['index']);   //Done
        Route::apiResource('transactions', TransactionController::class);
        Route::apiResource('transaction-passengers', TransactionPassengerController::class);

        Route::post('/promo-codes', [PromoCodeController::class, 'store']);             //Done
        Route::put('/promo-codes/{promoCode}', [PromoCodeController::class, 'update']);     //Done
        Route::delete('/promo-codes/{promoCode}', [PromoCodeController::class, 'destroy']);    //Done
    });
});
