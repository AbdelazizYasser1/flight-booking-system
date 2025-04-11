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

Route::post('/register', [AuthController::class, 'register'])->name('register');   
Route::post('/login', [AuthController::class, 'login'])->name('login');              

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user-profile', [AuthController::class, 'userProfile']);            
    Route::post('/logout', [AuthController::class, 'logout']);                      

    Route::get('/airports', [AirportController::class, 'index']);                  
    Route::get('/airports/{name}', [AirportController::class, 'show']);         
    Route::get('/airlines', [AirlineController::class, 'index']);               
    Route::get('/airlines/{name}', [AirlineController::class, 'show']);           

    Route::get('/flights', [FlightController::class, 'index']);                         
    Route::get('/flights/{flight_number}', [FlightController::class, 'show']);         
    Route::get('/flight-classes', [FlightClassController::class, 'index']);     
    Route::get('/flight-seats', [FlightSeatController::class, 'index']);        
    Route::get('/flight-segments', [FlightSegmentController::class, 'index']);  

    Route::get('/promo-codes', [PromoCodeController::class, 'index']);          
    Route::get('/promo-codes/{code}', [PromoCodeController::class, 'show']);    
    Route::get('/validate-promo/{code}', [PromoCodeController::class, 'validatePromoCode']); 

    Route::get('/facilities', [FacilityController::class, 'index']);            
    Route::get('/facilities/{name}', [FacilityController::class, 'show']);      

    Route::middleware('admin')->group(function () {
        Route::apiResource('facilities', FacilityController::class)->except(['index', 'show']); 
        Route::apiResource('airports', AirportController::class)->except(['index', 'show']);    
        Route::apiResource('airlines', AirlineController::class)->except(['index', 'show']);    
        Route::apiResource('flights', FlightController::class)->except(['index', 'show']);      
        Route::apiResource('flight-classes', FlightClassController::class)->except(['index']);  
        Route::apiResource('flight-seats', FlightSeatController::class)->except(['index']);     
        Route::apiResource('flight-segments', FlightSegmentController::class)->except(['index']);   
        Route::apiResource('transactions', TransactionController::class);
        Route::apiResource('transaction-passengers', TransactionPassengerController::class);

        Route::post('/promo-codes', [PromoCodeController::class, 'store']);             
        Route::put('/promo-codes/{promoCode}', [PromoCodeController::class, 'update']);     
        Route::delete('/promo-codes/{promoCode}', [PromoCodeController::class, 'destroy']);    
    });
});
