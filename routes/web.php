<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\SiblingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CocuriculumController;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\KivController;
use App\Http\Controllers\InterviewerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Interviewer\DashboardController as InterviewerDashboardController;

Route::get('/', function () {
    return view('login');
});

// Authentication routes
Route::post('/login-submit', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Admin routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/interview-marks', [InterviewerController::class, 'interviewerMark'])->name('admin.interviewerMark');
    Route::get('/admin/interview-marks/{id}/view', [InterviewerController::class, 'viewIVMark'])->name('admin.viewIVMark');

    // Staff routes
    Route::get('/admin/staff/assign', [StaffController::class, 'index'])->name('staff.assign');
    Route::get('/admin/staff/add', function () {
        return view('admin.addStaff');
    })->name('staff.add');
    Route::post('/admin/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/admin/staff/{id}', [StaffController::class, 'view'])->name('staff.view');
    Route::get('/admin/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/admin/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/admin/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    // Interviewer routes
    Route::get('/interviewer/dashboard', [InterviewerDashboardController::class, 'index'])->name('interviewer.dashboard');
    Route::get('/interviewer/recommend-list', [InterviewerController::class, 'recommendList'])->name('interviewer.recommendList');
    Route::get('/interviewer/candidate/{id}', [InterviewerController::class, 'view'])->name('interviewer.viewCandidate'); // Changed route name

    // Interview routes
    Route::get('/interview/questions/{id}', [InterviewerController::class, 'showQuestions'])->name('interview.questions');
    Route::post('/interview/questions/{id}', [InterviewerController::class, 'storeQuestions'])->name('interview.store');
    Route::get('/interview/marks', [InterviewerController::class, 'interviewerMark'])->name('interviewer.marks');
    Route::get('/interview/marks/{id}', [InterviewerController::class, 'viewInterviewMark'])->name('interviewer.viewMark');

    // Applicant routes
    Route::get('/applicant/dashboard', function () {
        return view('applicant.home');
    })->name('applicant.home');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Application form routes
    Route::get('/personal', [PersonalController::class, 'index'])->name('personal.form');
    Route::post('/personal', [PersonalController::class, 'store'])->name('personal.store');

    Route::get('/academic', [AcademicController::class, 'index'])->name('academic.form');
    Route::post('/academic', [AcademicController::class, 'store'])->name('academic.store');

    Route::get('/cocuriculum', [CocuriculumController::class, 'index'])->name('cocuriculum.form');
    Route::post('/cocuriculum', [CocuriculumController::class, 'store'])->name('cocuriculum.store');

    Route::get('/parent', [ParentController::class, 'index'])->name('parent.form');
    Route::post('/parent', [ParentController::class, 'store'])->name('parent.store');

    // Guardian routes
    Route::get('/guardian', [GuardianController::class, 'index'])->name('guardian.form');
    Route::post('/guardian', [GuardianController::class, 'store'])->name('guardian.store');

    // Siblings routes
    Route::get('/siblings', [SiblingsController::class, 'index'])->name('siblings.form');
    Route::post('/siblings', [SiblingsController::class, 'store'])->name('siblings.store');
    Route::delete('/siblings/{id}', [SiblingsController::class, 'destroy'])->name('siblings.destroy')->where('id', '[0-9]+');

    // Recommend routes
    Route::get('/recommend', [RecommendController::class, 'index'])->name('recommend.index');
    Route::get('/recommend/{id}/view', [RecommendController::class, 'viewCandidate'])->name('recommend.view');
    Route::get('/recommend/{id}', [RecommendController::class, 'view'])->name('recommend.view');
    Route::get('/recommend/viewCandidate/{id}', [RecommendController::class, 'viewCandidate'])->name('recommend.viewCandidate');

    // Kiv routes
    Route::get('/kiv', [KivController::class, 'index'])->name('kiv.index');
    Route::get('/kiv/{id}/view', [KivController::class, 'viewCandidate'])->name('kiv.view');
    Route::get('/kiv/{id}/edit', [KivController::class, 'edit'])->name('kiv.edit');
    Route::post('/kiv/{id}/update', [KivController::class, 'update'])->name('kiv.update');
    Route::get('/kiv/viewCandidate/{id}', [KivController::class, 'viewCandidate'])->name('kiv.viewCandidate');

    // Declaration route
    Route::get('/declaration', function () {
    return view('applicant.declaration');
})->name('applicant.declaration');
});

require __DIR__.'/auth.php';
