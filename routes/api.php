<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// roles
use App\Actions\Roles\StoreRoleAction;
use App\Actions\Roles\DeleteRoleAction;
use App\Actions\Roles\UpdateRoleAction;
use App\Actions\Roles\GetRoleAction;
use App\Actions\Roles\GetRoleListAction;

// permissions
use App\Actions\Permissions\GetPermissionsByRoleAction;
use App\Actions\Permissions\AssignPermissionToRoleAction;
use App\Actions\Permissions\AssignOnePermissionToRoleAction;
use App\Actions\Permissions\GetPermissionListAction;
use App\Actions\Permissions\StorePermissionAction;

// auth
use App\Actions\Auth\User\UserLoginAction;
use App\Actions\Auth\User\UserRegisterAction;



Route::group(['prefix' => 'auth'], function () {
    Route::post('', UserLoginAction::class);
    Route::put('', UserRegisterAction::class);

});

Route::group(['prefix'=>'permissions'], function(){
    Route::post('assign', AssignPermissionToRoleAction::class);
    Route::get('', GetPermissionListAction::class);
    Route::get('{id}',GetPermissionsByRoleAction ::class);
    Route::put('', StorePermissionAction::class);
    //AssignOnePermissionToRoleAction
    Route::post('assignOnePermissionToRole', AssignOnePermissionToRoleAction::class);
});
Route::group(['prefix'=>'roles'], function(){
    Route::get('', GetRoleListAction::class);
    Route::get('{id}', GetRoleAction::class);
    Route::put('', StoreRoleAction::class);
    Route::post('{id}', UpdateRoleAction::class);
    Route::delete('{id}', DeleteRoleAction::class);
});
