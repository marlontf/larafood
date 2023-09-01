<?php

use App\Http\Controllers\admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
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

Route::prefix('admin')->group(function () {

    /**
     * Routes Details Plan
     */
    Route::post('plans/{url}/details', [DetailPlanController::class,'store'])->name('details.plan.store');
    Route::get('plans/{url}/details/create', [DetailPlanController::class,'create'])->name('details.plan.create');
    Route::get('plans/{url}/details', [DetailPlanController::class,'index'])->name('details.plan.index');

    /**
     * Routes Plan
     */
    Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
    Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
    Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');

    /**
     * Home Dashboard
     */
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});





Route::get('/', function () {
    return view('welcome');
});
