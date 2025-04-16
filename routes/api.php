<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotManController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('translations/{locale}', function ($locale) {
    // Implementasikan logika untuk mengambil terjemahan dari database atau sumber lain
    $translations = [
        'en' => [
            'Welcome to' => 'Welcome to',
        ],
        'ar' => [
            'Welcome to' => 'مرحبا بكم في',
        ],
        'id' => [
            'Welcome to' => 'Selamat datang di',
        ],
    ];

    return response()->json($translations[$locale] ?? $translations['en']);
});

// Route untuk FAQ Data
Route::get('/faq-data', [BotManController::class, 'getFaqData']);
