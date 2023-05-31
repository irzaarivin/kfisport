<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/save-spreadsheet", [EmployeeController::class, 'saveSheet']);
Route::post("/get-spreadsheet", [EmployeeController::class, 'getSheet']);
Route::get("/getProductData", [EmployeeController::class, 'getProductData']);

//http://127.0.0.1:8000/api/getProductData