<?php

use App\Http\Controllers\MenteeExperienceController;
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
Route::middleware(['auth:sanctum', 'verified','can:mentee-only'])->post('/mentees/experiences', [MenteeExperienceController::class,'store'])->name('store.mentee.experience');

