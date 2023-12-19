<?php

use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\FormationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



/*route pour formation*/
Route::get('formation/index', [FormationController::class, 'index']);

Route::middleware(['auth:api', 'access:admin'])->group(function () {

    Route::post('store', [FormationController::class, 'store']);
    Route::post('formation/update/{id}', [FormationController::class, 'update']);
    Route::get('formation/show/{formation}', [FormationController::class, 'show']);
    Route::post('formation/delete/{formation}', [FormationController::class, 'destroy']);
    Route::post('formation/cloturer/{formation}', [FormationController::class, 'cloturer']);
    Route::post('candidature/refuser/{candidature}', [CandidatureController::class, 'refuser']);
    Route::get('candidature/show/{candidature}', [CandidatureController::class, 'show']);
    Route::get('candidature/index', [CandidatureController::class, 'index']);
    Route::get('candidature/acceptees', [CandidatureController::class, 'candidaturesAcceptees']);
    Route::get('candidature/refusees', [CandidatureController::class, 'candidatureRefusees']);


});
/*routes pour les candidatures*/
Route::middleware(['auth:api', 'access:user'])->group(function () {

    Route::post('candidature/store', [CandidatureController::class, 'store']);
    Route::get('candidature/show/{candidature}', [CandidatureController::class, 'show']);
    Route::get('candidature/user/{id}', [CandidatureController::class, 'userCandidature']);


});


/*route pour authentification*/
Route::post('register', [AuthController::class, 'register']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);


});
