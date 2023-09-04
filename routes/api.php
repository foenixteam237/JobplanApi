<?php

use App\Http\Controllers\API\PlanningController;
use App\Http\Controllers\API\ProgramController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource("users", UserController::class);

    Route::get('users/{id}', [UserController::class, 'show']);
});

Route::post('/users', [UserController::class, 'store']);
Route::post('login',[UserController::class,'login'])->name('login');
//Route::apiResource('/users', UserController::class);
Route::apiResource('/plannings', PlanningController::class);
Route::apiResource('/programs', ProgramController::class);
