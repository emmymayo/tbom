<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenteeConnectRequestController;
use App\Http\Controllers\MenteeExperienceController;
use App\Http\Controllers\MenteeProfileController;
use App\Http\Controllers\MentorAssessmentController;
use App\Http\Controllers\MentorConnectRequestController;
use App\Http\Controllers\MentorExpertiseController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\MentorSearchController;
use App\Http\Controllers\MyMenteeController;
use App\Http\Controllers\MyMentorController;
use App\Http\Controllers\UpdateMenteeProfileInformationController;
use App\Http\Controllers\UpdateMentorProfileInformationController;
use App\Http\Controllers\UserDocumentDownloadController;
use App\Http\Controllers\UserDocumentUploadController;
use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\Nationality;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'mentee_count' => Mentee::all()->count(),
        'mentor_count' => Mentor::all()->count(),
        
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', DashboardController::class)->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])
        ->post('/users/documents/upload', UserDocumentUploadController::class)
        ->name('current-user-document-upload');
        
Route::middleware(['auth:sanctum', 'verified'])
        ->get('/users/documents/{user_document}/download', UserDocumentDownloadController::class)
        ->name('user-document-download');

Route::middleware(['auth:sanctum', 'verified'])
        ->put('/mentees/profile/info/update', UpdateMenteeProfileInformationController::class)
        ->name('mentee-profile-information.update');

Route::middleware(['auth:sanctum', 'verified'])
        ->put('/mentors/profile/info/update', UpdateMentorProfileInformationController::class)
        ->name('mentor-profile-information.update');

Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->get('/mentees/experiences', [MenteeExperienceController::class,'index'])->name('mentee.experience');
Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->get('/mentees/experiences/create', [MenteeExperienceController::class,'create'])->name('create.mentee.experience');
Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->get('/mentees/experiences/{experience}/edit', [MenteeExperienceController::class,'edit'])->name('edit.mentee.experience');
Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->post('/mentees/experiences', [MenteeExperienceController::class,'store'])->name('store.mentee.experience');
Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->put('/mentees/experiences/{experience}', [MenteeExperienceController::class,'update'])->name('update.mentee.experience');
Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->delete('/mentees/experiences/{experience}', [MenteeExperienceController::class,'destroy'])->name('destroy.mentee.experience');

//Mentor Expertise
Route::middleware(['auth:sanctum', 'verified','can:mentor-only'])->get('/mentors/expertises', [MentorExpertiseController::class,'index'])->name('mentor.expertise');
Route::middleware(['auth:sanctum', 'verified','can:mentor-only'])->get('/mentors/expertises/create', [MentorExpertiseController::class,'create'])->name('create.mentor.expertise');
Route::middleware(['auth:sanctum', 'verified','can:mentor-only'])->get('/mentors/expertises/{mentor_expertise}/edit', [MentorExpertiseController::class,'edit'])->name('edit.mentor.expertise');
Route::middleware(['auth:sanctum', 'verified','can:mentor-only'])->post('/mentors/expertises', [MentorExpertiseController::class,'store'])->name('store.mentor.expertise');
Route::middleware(['auth:sanctum', 'verified','can:mentor-only'])->put('/mentors/expertises/{mentor_expertise}', [MentorExpertiseController::class,'update'])->name('update.mentor.expertise');
Route::middleware(['auth:sanctum', 'verified','can:mentor-only'])->delete('/mentors/expertises/{mentor_expertise}', [MentorExpertiseController::class,'destroy'])->name('destroy.mentor.expertise');


Route::middleware(['auth:sanctum', 'verified'])
        ->get('/search/mentors', [MentorSearchController::class,'index'])
        ->name('mentor.search.index');

Route::middleware(['auth:sanctum', 'verified'])
        ->patch('/mentors/connects/requests', MentorConnectRequestController::class)
        ->name('mentor.connect.request');

Route::middleware(['auth:sanctum', 'verified'])
        ->patch('/mentees/connects/requests', MenteeConnectRequestController::class)
        ->name('mentee.connect.request');

Route::middleware(['auth:sanctum', 'verified'])
        ->get('/mentors/profile/{mentor}', MentorProfileController::class)
        ->name('mentor.profile');

Route::middleware(['auth:sanctum', 'verified'])
        ->get('/mentees/profile/{mentee}', MenteeProfileController::class)
        ->name('mentee.profile');

Route::middleware(['auth:sanctum','verified'])->get('/my-mentors',[MyMentorController::class,'index'])->name('my-mentor.index');
Route::middleware(['auth:sanctum','verified'])->get('/my-mentees',[MyMenteeController::class,'index'])->name('my-mentee.index');

Route::middleware(['auth:sanctum','verified'])->get('/mentors/{mentor}/assessments/edit',[MentorAssessmentController::class,'edit'])
                ->name('mentor-assessment.edit');
Route::middleware(['auth:sanctum','verified'])->put('/mentors/{mentor}/assessments',[MentorAssessmentController::class,'update'])
                ->name('mentor-assessment.update');

