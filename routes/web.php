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
    return redirect()->route('login');
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
    Route::get('/classrooms/{classroom}/students', [ClassroomController::class, 'students'])->name('classrooms.students');

    Route::get('/classrooms/{classroom}/assignments/create', [AssignmentController::class, 'create'])->name('classrooms.assignments.create');
    Route::post('/classrooms/{classroom}/assignments', [AssignmentController::class, 'store'])->name('classrooms.assignments.store');
    Route::get('/assignments/{assignment}/file', [AssignmentController::class, 'file'])->name('assignments.file');

    Route::get('/assignments/{assignment}/submissions', [SubmissionController::class, 'index'])->name('assignments.submissions.index');
    Route::put('/submissions/{submission}/grade', [SubmissionController::class, 'updateGrade'])->name('submissions.grade');
    Route::get('/submissions/{submission}/file', [SubmissionController::class, 'file'])->name('submissions.file');
});


// Student routes
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        // Student dashboard
        Route::get('/', [ClassroomJoinController::class, 'index'])->name('index');
        
        // Join classroom by code
        Route::get('/join', [ClassroomJoinController::class, 'showJoinForm'])->name('join.form');
        Route::post('/join', [ClassroomJoinController::class, 'join'])->name('join');
        Route::get('/classroom/{join_code}', [ClassroomJoinController::class, 'join'])->name('classroom.join');
        Route::get('/classroom-view/{classroom}', [ClassroomJoinController::class, 'showClassroom'])->name('classroom.view');

        // Submit assignment
        Route::get('/assignments/{assignment}', [StudentSubmissionController::class, 'create'])->name('assignments.show');
        Route::post('/assignments/{assignment}/submit', [StudentSubmissionController::class, 'store'])->name('assignments.submit');
        Route::get('/assignments/{assignment}/file', [App\Http\Controllers\Teacher\AssignmentController::class, 'file'])->name('assignments.file');
    });

require __DIR__.'/auth.php';

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::put('/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

