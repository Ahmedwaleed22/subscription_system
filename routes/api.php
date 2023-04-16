<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/websites', [WebsiteController::class, 'all']);

Route::get('/websites/{website}/posts', [WebsiteController::class, 'show']);

Route::post('/websites/{website}/posts', [PostController::class, 'add']);

Route::post('/websites/{websiteID}', [WebsiteController::class, 'subscribe']);