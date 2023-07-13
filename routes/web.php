<?php

use App\Http\Controllers\CreateDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidateIjazahController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/mahasiswa')->middleware('can:admin')->group(function (){
        Route::get('/', [CreateDataController::class, 'home'])->name('mahasiswa');
        Route::get('/add', [CreateDataController::class, 'createMahasiswa']);
        Route::get('/detail', [CreateDataController::class, 'detailMahasiswa']);

        Route::post('add', [CreateDataController::class, 'postMahasiswa'])->name('create-mahasiswa');
        Route::post('edit', [CreateDataController::class, 'updateMahasiswa'])->name('edit-mahasiswa');
        Route::post('add/ijazah', [CreateDataController::class, 'createIjazah'])->name('add-ijazah-mahasiswa');
    });
});

Route::get('/test', function (\Illuminate\Http\Request $request){
    if (! \Illuminate\Support\Facades\Gate::allows('admin')){
        abort(403);
    }
});





Route::post('store', [ValidateIjazahController::class, 'storefile']);
require __DIR__.'/auth.php';
