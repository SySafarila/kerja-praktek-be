<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminIndex;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExtracurricularsController;
use App\Http\Controllers\GalleriesController;
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
})->name('landingpage');

Route::view('/authentication', 'authentication');

Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// admin pages
Route::middleware(['auth', 'verified', 'can:admin-access'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminIndex::class)->name('index');

    // roles & permissions
    Route::resource('/permissions', PermissionController::class)->except(['show']);
    Route::resource('/roles', RoleController::class)->except(['show']);

    // users
    Route::resource('/users', UserController::class)->except(['show']);

    // blogs | comment this route below to disable Blog features
    Route::resource('/blogs', BlogController::class);

    // staffs
    Route::resource('/staffs', StaffController::class)->except(['show']);

    // teachers
    Route::resource('/teachers', TeacherController::class)->except(['show']);

    // subjects
    Route::resource('/subjects', SubjectController::class)->except(['show']);

    // extracurricular
    Route::resource('/extracurriculars', ExtracurricularsController::class)->except(['show']);

    // extracurricular
    Route::resource('/galleries', GalleriesController::class)->except(['show']);

    // bulk delete
    Route::delete('/bulk-delete/permissions', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::delete('/bulk-delete/roles', [RoleController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::delete('/bulk-delete/users', [UserController::class, 'massDestroy'])->name('users.massDestroy');
    Route::delete('/bulk-delete/blogs', [BlogController::class, 'massDestroy'])->name('blogs.massDestroy');
    Route::delete('/bulk-delete/staffs', [StaffController::class, 'massDestroy'])->name('staffs.massDestroy');
    Route::delete('/bulk-delete/teachers', [TeacherController::class, 'massDestroy'])->name('teachers.massDestroy');
    Route::delete('/bulk-delete/subjects', [SubjectController::class, 'massDestroy'])->name('subjects.massDestroy');
    Route::delete('/bulk-delete/extracurriculars', [ExtracurricularsController::class, 'massDestroy'])->name('extracurriculars.massDestroy');
});

// account re-verification
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('account/verify-new-email/{token}', [AccountController::class, 'verifyNewEmail'])->name('account.verifyNewEmail');
    Route::resource('account', AccountController::class)->only(['index', 'edit', 'update']);
});

require __DIR__ . '/auth.php';
