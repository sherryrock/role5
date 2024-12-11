<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

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
});

require __DIR__.'/auth.php';


Route::group(['middleware' => ['role:Admin']], function () {
});

Route::group(['middleware' => ['role:Teacher']], function () {
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
});

Route::group(['middleware' => ['role:Student']], function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
