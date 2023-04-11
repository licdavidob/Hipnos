<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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

Route::get('/', [UsuarioController::class, 'index'])->middleware(['auth:sanctum'])->name('dashboard');
Route::post('/', [UsuarioController::class, 'store'])->middleware(['auth:sanctum'])->name('guardar');
Route::get('create', [UsuarioController::class, 'create'])->middleware(['auth:sanctum'])->name('crear');
Route::get('editar/{usuario}', [UsuarioController::class, 'edit'])->middleware(['auth:sanctum'])->name('editar');
Route::put('actualizar/{usuario}', [UsuarioController::class, 'update'])->middleware(['auth:sanctum'])->name('actualizar');
Route::delete('eliminar/{usuario}', [UsuarioController::class, 'destroy'])->middleware('auth:sanctum')->name('borrar');
Route::apiResource('/Usuario', UsuarioController::class);

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
