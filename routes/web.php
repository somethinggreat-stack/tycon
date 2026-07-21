<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

/* ---------- Division pages ---------- */
Route::get('/personal-credit', function () {
    return view('divisions.personal');
})->name('division.personal');

Route::get('/business-credit', function () {
    return view('divisions.business');
})->name('division.business');

Route::get('/financial-investments', function () {
    return view('divisions.financial');
})->name('division.financial');

Route::post('/lead', [LeadController::class, 'store'])->name('lead.store');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

/* ---------- Legal ---------- */
Route::view('/terms-of-service', 'legal.terms')->name('legal.terms');
Route::view('/privacy-policy', 'legal.privacy')->name('legal.privacy');
Route::view('/disclaimer', 'legal.disclaimer')->name('legal.disclaimer');

/* ---------- Secure client onboarding ---------- */
Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');
Route::get('/onboarding/thank-you', [OnboardingController::class, 'thanks'])->name('onboarding.thanks');

/* ---------- Admin ---------- */
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(AdminAuth::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/onboarding/{onboarding}/doc/{field}', [AdminController::class, 'downloadDoc'])->name('admin.onboarding.doc');
    Route::post('/admin/onboarding/{onboarding}/apex-retry', [AdminController::class, 'retryApex'])->name('admin.onboarding.apex');
    Route::post('/admin/session/extend', [AdminController::class, 'extendSession'])->name('admin.session.extend');
});
