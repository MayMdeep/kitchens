<?php

use Illuminate\Support\Facades\Route;
// kitchens
use Modules\Kitchen\App\Actions\Kitchens\GetKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\StoreKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\DeleteKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\UpdateKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\GetKitchenListAction;

// kitchens


/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
 */
Route::prefix('api')->group(function () {

    Route::prefix('kitchenmodule')->group(function () {

        Route::group(['prefix' => 'kitchens'], function () {
            Route::get('', GetKitchenListAction::class);
            Route::get('{id}', GetKitchenAction::class);
            Route::put('', StoreKitchenAction::class);
            Route::post('{id}', UpdateKitchenAction::class);
            Route::delete('{id}', DeleteKitchenAction::class);
        });

    });//kitchenmodule  close
}); // apis close
