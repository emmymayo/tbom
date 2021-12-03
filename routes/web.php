<?php

use App\Http\Controllers\MenteeExperienceController;
use App\Http\Controllers\MentorConnectRequestController;
use App\Http\Controllers\MentorExpertiseController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\MentorSearchController;
use App\Http\Controllers\MyMentorController;
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
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        
    ]);
})->name('dashboard');

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
        ->get('/mentors/profile/{mentor}', MentorProfileController::class)
        ->name('mentor.profile');

Route::middleware(['auth:sanctum','verified'])->get('/my-mentors',[MyMentorController::class,'index'])->name('my-mentor.index');

