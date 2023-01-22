<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\QueueController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('add-queue', [QueueController::class, 'addQueue']);
Route::delete('chats/{chatId}/delete-queue', [QueueController::class, 'deleteQueue']);

Route::get('get-chat', [ChatController::class, 'getChat']);
Route::post('create-chat', [ChatController::class, 'createChat']);

Route::delete('delete-chat/{chatId}', [ChatController::class, 'deleteChat']);

Route::get('get-active-chat/{chatId}', [ChatController::class, 'getActiveChat']);