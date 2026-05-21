<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer Routes
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    
    // ChecklistTemplate Routes
    Route::resource('templates', \App\Http\Controllers\ChecklistTemplateController::class);
    Route::post('/templates/{template}/structure', [\App\Http\Controllers\ChecklistTemplateController::class, 'updateStructure'])->name('templates.structure.update');
    
    // Report Routes
    Route::resource('reports', \App\Http\Controllers\ChecklistReportController::class);
    Route::post('/reports/{report}/answers', [\App\Http\Controllers\ChecklistReportController::class, 'saveAnswers'])->name('reports.answers.save');
    Route::post('/reports/{report}/photo', [\App\Http\Controllers\ChecklistReportController::class, 'uploadPhoto'])->name('reports.photo.upload');
    Route::get('/reports/{report}/pdf', [\App\Http\Controllers\ChecklistReportController::class, 'exportPdf'])->name('reports.pdf');
});

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('plans', \App\Http\Controllers\Admin\PlanController::class);
});

// SEO & Sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Public pages
Route::get('/recursos', function () { return Inertia::render('Public/Features'); })->name('features');
Route::get('/precos', function () { return Inertia::render('Public/Pricing'); })->name('pricing');
Route::get('/termos', function () { return Inertia::render('Public/Terms'); })->name('terms');
Route::get('/privacidade', function () { return Inertia::render('Public/Privacy'); })->name('privacy');
Route::get('/relatorio/{token}', [\App\Http\Controllers\ChecklistReportController::class, 'publicShow'])->name('public.report');

require __DIR__.'/auth.php';
