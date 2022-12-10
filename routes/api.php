<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisccussionController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('surveys', SurveyController::class);
    Route::apiResource('survey.questions', QuestionController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('survey.responses', ResponseController::class)->only(['store']);
    Route::apiResource('folders', FolderController::class)->only(['store', 'index', 'destroy', 'show']);
    Route::apiResource('discussions', DisccussionController::class)->only(['store', 'index', 'destroy', 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
