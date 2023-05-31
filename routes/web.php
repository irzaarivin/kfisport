<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){

    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::get('/login', [UserController::class, 'index'])->name('login');

    Route::post('/', [UserController::class, 'login']);
    Route::post('/login', [UserController::class, 'login']);

});

// Route::middleware('auth')->group(function(){

//     Route::middleware("checkrole:admin")->group(function(){

//         Route::get('/', [AdminController::class, 'index']);

//         Route::get('/attendance', [AdminController::class, 'attendance']);

//     });

//     Route::middleware("checkrole:employee")->group(function(){

//         Route::get('/', [EmployeeController::class, 'index']);

//         Route::get('/attendance', [EmployeeController::class, 'attendance']);
//         Route::post('/attendance', [EmployeeController::class, 'attendanceHandle']);

//         Route::get('/employees', [EmployeeController::class, 'employees']);

//         Route::get("/report", [EmployeeController::class, 'report']);

//         Route::get('/logout', [EmployeeController::class, 'logout']);

//     });

// });

Route::middleware('auth')->group(function(){

        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('/', [EmployeeController::class, 'employeeHandle']);

        Route::get('/attendance', [EmployeeController::class, 'attendance']);
        Route::post('/attendance', [EmployeeController::class, 'attendanceHandle']);

        Route::get('/employees', [EmployeeController::class, 'employees']);
        Route::post('/employees', [EmployeeController::class, 'employeesHandle']);

        Route::get("/report", [EmployeeController::class, 'report']);
        Route::post("/report", [EmployeeController::class, 'reportHandle']);

        Route::get("/products", [EmployeeController::class, 'product']);
        Route::post("/products", [EmployeeController::class, 'productHandle']);

        Route::get("/products/generate", [EmployeeController::class, 'generateRecap']);

        Route::post("/products/change-data", [EmployeeController::class, 'productDataHandle']);
        Route::post("/products/add-product-in", [EmployeeController::class, 'productDataInHandle']);
        Route::post("/products/add-product-out", [EmployeeController::class, 'productDataOutHandle']);

        Route::post("/upload-profil-image", [EmployeeController::class, 'uploadProfileImage']);

        Route::get("/spreadsheet", [EmployeeController::class, 'spreadsheet']);
        Route::post("/spreadsheet", [EmployeeController::class, 'createSheet']);

        Route::get("/spreadsheet/{slug}", [EmployeeController::class, 'sheetHandle']);
        Route::post("/spreadsheet/{slug}", [EmployeeController::class, 'sheetHandle']);

        Route::get('/logout', [EmployeeController::class, 'logout']);

});

// Route::middleware('auth')->group(function(){

//     if (auth()->user()->role == "admin") {

//         Route::get('/', [AdminController::class, 'index']);

//         Route::get('/attendance', [AdminController::class, 'attendance']);

//     } else {

//         Route::get('/', [EmployeeController::class, 'index']);

//         Route::get('/attendance', [EmployeeController::class, 'attendance']);
//         Route::post('/attendance', [EmployeeController::class, 'attendanceHandle']);

//         Route::get('/employees', [EmployeeController::class, 'employees']);

//         Route::get("/report", [EmployeeController::class, 'report']);

//         Route::get('/logout', [EmployeeController::class, 'logout']);

//     }

// });