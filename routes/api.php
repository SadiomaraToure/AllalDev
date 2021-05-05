<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

//affichage profil user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//authentification user
Route::post("/token", [AuthController::class, "token"]);

//inscription user
Route::post("/register", [AuthController::class, "register"]);
//Route::middleware('auth:sanctum')->get("/user", [AuthController::class, 'profile']);
Route::middleware('auth:sanctum')->get("/refresh", [AuthController::class, 'refresh']);

//authentification TPE
Route::post("/tpeauth", [AuthController::class, "authentificationTPE"]);

//Achat Ticket par TPE
Route::middleware('auth:sanctum')->post('/acheterTicket',  [AuthController::class, 'getTicketparTPE']);

//Verification ticket
Route::post("/ticket", [AuthController::class, "autTicket"]);

//mise a jour ticket
Route::post("/ticketvalider", [AuthController::class, "miseajourTicket"]);

//affichage liste ticket
Route::middleware('auth:sanctum')->get('/listeticket',  [AuthController::class, 'listeticket']);
