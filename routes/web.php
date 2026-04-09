<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\Aku92Controller;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FormController;

// Home (standalone)
Route::get('/', fn () => view('home'));

// Person landing pages (standalone)
Route::get('/dr-akash-jain', [PersonController::class, 'akashJain']);
Route::get('/dr-prashuka-jain', [PersonController::class, 'prashukaJain']);

// General pages (use app layout)
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/product', [PageController::class, 'product']);
Route::get('/online-medicine', [PageController::class, 'onlineMedicine']);
Route::get('/opd-form', [PageController::class, 'opdForm']);

// AKU92 section (using /healthcare prefix to avoid collision with nginx mount)
Route::get('/healthcare', [Aku92Controller::class, 'index']);
Route::get('/healthcare/clinics', [Aku92Controller::class, 'clinics']);
Route::get('/healthcare/jain-medicines', [Aku92Controller::class, 'jainMedicines']);
Route::get('/healthcare/physiotherapy', [Aku92Controller::class, 'physiotherapy']);
Route::get('/healthcare/review', [Aku92Controller::class, 'review']);
Route::get('/healthcare/opd-form', [Aku92Controller::class, 'opdForm']);

// Shop section
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/product/{id}', [ShopController::class, 'show']);
Route::get('/shop/cart', [ShopController::class, 'cart']);
Route::get('/shop/checkout', [ShopController::class, 'checkout']);

// API endpoints
Route::post('/api/contact', [FormController::class, 'contact']);
Route::post('/api/opd', [FormController::class, 'opd']);
