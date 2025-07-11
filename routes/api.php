<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\User_masterController;
use App\Http\Controllers\Api\ClientformController;
use App\Http\Controllers\Api\RecruitmentController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\ProcessTrackerController;

Route::prefix('v1')->group(function () {

    /**
     * --------------------------------------
     * PUBLIC ROUTES (No Authentication)
     * --------------------------------------
     */
    Route::post('/login', [User_masterController::class, 'login']);

    Route::apiResources([
        'clientforms'   => ClientformController::class,
        'recruitments'  => RecruitmentController::class,
        'candidates'    => CandidateController::class,
    ]);

    // Process Tracker Store Route (optional: you can protect this later)
    Route::post('/process-tracker', [ProcessTrackerController::class, 'store']);

    /**
     * --------------------------------------
     * PROTECTED ROUTES (Require Sanctum Auth)
     * --------------------------------------
     */
    Route::middleware('auth:sanctum')->group(function () {

        // Get authenticated user info
        Route::get('/user', function (Request $request) {
            return response()->json($request->user());
        });

        // Example: Additional secured routes
        // Route::put('/candidates/{id}/status', [CandidateController::class, 'updateStatus']);
    });
});

/**
 * --------------------------------------
 * GLOBAL FALLBACK ROUTE (Handles 404s)
 * --------------------------------------
 */
Route::fallback(function () {
    return response()->json([
        'status'  => false,
        'message' => 'API endpoint not found',
        'data'    => null,
    ], 404);
});
