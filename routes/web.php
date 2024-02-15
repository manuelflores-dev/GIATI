<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

    //Routes Empleado
    Route::get('/empleado/crear', [EmpleadoController::class, 'create'])->name('empleado.create');
    Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.index');
    Route::post('/empleado', [EmpleadoController::class, 'store'])->name('empleado.store');
    Route::get('/buscar-emleado', [EmpleadoController::class, 'buscar'])->name('buscar.empleado');
    Route::get('/empleado/{empleado}', [EmpleadoController::class, 'edit'])->name('empleado.edit');
    Route::patch('/empleado/{empleado}', [EmpleadoController::class, 'update'])->name('empleado.update');
    Route::delete('/empleado/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleado.destroy');
});

require __DIR__.'/auth.php';
