<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OwenIt\Auditing\Models\Audit;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'middleware' => 'api', 'namespace' => 'App\Http\Controllers'], function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('registration', [ApiAuthController::class, 'registration']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::get('user', [ApiAuthController::class, 'user']);
    Route::get('/audits', function(){
        return successResponse(200, Audit::all(), 'Audit List');
    });
});

Route::apiResources([
    'addresses' => AddressController::class,
], ['as' => 'api']);
