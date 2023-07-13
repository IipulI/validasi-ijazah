<?php

use App\Http\Controllers\CreateDataController;
use App\Http\Controllers\ValidateIjazahController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('validate/ijazah', [ValidateIjazahController::class, 'validateIjazah']);
Route::get('mahasiswa', [CreateDataController::class, 'listMahasiswa']);
Route::get('fakultas', [CreateDataController::class, 'listFakultas']);
Route::get('prodi', [CreateDataController::class, 'listProdi']);
