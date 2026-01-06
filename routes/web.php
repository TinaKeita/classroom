<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Teacher\ClassroomController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\SubmissionController;
use App\Http\Controllers\Student\ClassroomJoinController;
use App\Http\Controllers\Student\SubmissionController as StudentSubmissionController;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes - protected
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\AdminController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\AdminController::class, 'store'])->name('store');
});


Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('/classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create');
    Route::post('/classrooms', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('/classrooms/{classroom}', [ClassroomController::class, 'show'])->name('classrooms.show');

    Route::get('/classrooms/{classroom}/assignments/create', [AssignmentController::class, 'create'])->name('classrooms.assignments.create');
    Route::post('/classrooms/{classroom}/assignments', [AssignmentController::class, 'store'])->name('classrooms.assignments.store');

    Route::get('/assignments/{assignment}/submissions', [SubmissionController::class, 'index'])->name('assignments.submissions.index');
    Route::put('/submissions/{submission}/grade', [SubmissionController::class, 'updateGrade'])->name('submissions.grade');
});


// Student routes
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        // Join classroom by code
        Route::get('/join', [ClassroomJoinController::class, 'showJoinForm'])->name('join.form');
        Route::post('/join', [ClassroomJoinController::class, 'join'])->name('join');

        // Submit assignment
        Route::get('/assignments/{assignment}', [StudentSubmissionController::class, 'create'])->name('assignments.show');
        Route::post('/assignments/{assignment}/submit', [StudentSubmissionController::class, 'store'])->name('assignments.submit');
    });

require __DIR__.'/auth.php';

