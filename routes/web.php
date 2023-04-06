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

// Route::get('/', function () {
//     return "Holi";
// });
// })->middleware('auth:sanctum');

Route::get('/', [UsuarioController::class, 'index'])->middleware(['auth:sanctum'])->name('dashboard');
Route::get('/create', [UsuarioController::class, 'create'])->middleware(['auth:sanctum'])->name('crear');

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
