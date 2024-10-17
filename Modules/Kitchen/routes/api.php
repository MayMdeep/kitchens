<?php

use Illuminate\Support\Facades\Route;
// kitchens
use Modules\Kitchen\App\Actions\Kitchens\GetKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\StoreKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\DeleteKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\UpdateKitchenAction;
use Modules\Kitchen\App\Actions\Kitchens\GetKitchenListAction;
//locations
use Modules\Kitchen\App\Actions\Locations\GetLocationListAction;
use Modules\Kitchen\App\Actions\Locations\GetLocationAction;
use Modules\Kitchen\App\Actions\Locations\StoreLocationAction;
use Modules\Kitchen\App\Actions\Locations\UpdateLocationAction;
use Modules\Kitchen\App\Actions\Locations\DeleteLocationAction;
//products
use Modules\Kitchen\App\Actions\Products\GetProductListAction;
use Modules\Kitchen\App\Actions\Products\GetProductAction;
use Modules\Kitchen\App\Actions\Products\StoreProductAction;
use Modules\Kitchen\App\Actions\Products\UpdateProductAction;
use Modules\Kitchen\App\Actions\Products\DeleteProductAction;
use Modules\Kitchen\App\Actions\Products\WithdrawProductAction;


//sublocations
use Modules\Kitchen\App\Actions\SubLocations\GetSubLocationListAction;
use Modules\Kitchen\App\Actions\SubLocations\GetSubLocationAction;
use Modules\Kitchen\App\Actions\SubLocations\StoreSubLocationAction;
use Modules\Kitchen\App\Actions\SubLocations\UpdateSubLocationAction;
use Modules\Kitchen\App\Actions\SubLocations\DeleteSubLocationAction;
use Modules\Kitchen\App\Actions\Products\GetProductActionByQR;
//

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
        Route::group(['prefix' => 'locations'], function () {
            Route::get('', GetLocationListAction::class);
            Route::get('{id}', GetLocationAction::class);
            Route::put('', StoreLocationAction::class);
            Route::post('{id}', UpdateLocationAction::class);
            Route::delete('{id}', DeleteLocationAction::class);
        });
        
        Route::group(['prefix' => 'locations'], function () {
            Route::get('', GetLocationListAction::class);
            Route::get('{id}', GetLocationAction::class);
            Route::put('', StoreLocationAction::class);
            Route::post('{id}', UpdateLocationAction::class);
            Route::delete('{id}', DeleteLocationAction::class);
        });
        Route::group(['prefix' => 'products'], function () {
            Route::get('', GetProductListAction::class);
            Route::get('{id}', GetProductAction::class);

            //extra since I didn't set the identifier to qrcode
            // since it's a very long attribute 64based i set the route to post
            Route::post('', GetProductActionByQR::class);

            Route::put('', StoreProductAction::class);
            Route::post('{id}', UpdateProductAction::class);
            Route::delete('{id}', DeleteProductAction::class);
            //

        });
        Route::group(['prefix' => 'sublocations'], function () {
            Route::get('', GetSubLocationListAction::class);
            Route::get('{id}', GetSubLocationAction::class);
            Route::put('', StoreSubLocationAction::class);
            Route::post('{id}', UpdateSubLocationAction::class);
            Route::delete('{id}', DeleteSubLocationAction::class);
        });

    });//kitchenmodule  close
}); // apis close
