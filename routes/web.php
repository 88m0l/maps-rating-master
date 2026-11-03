<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\SendReport;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index']);

// مصادقة
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// الإشارات المرجعية
Route::get('bookmark/{place_id}', [BookmarkController::class, 'bookmark'])->name('bookmark');
Route::get('bookmarks', [BookmarkController::class, 'getByUser'])->name('bookmarks');

// الإبلاغ
Route::resource('report', ContactController::class, ['only' => ['create','store']]);

// البحث
Route::get('/search', [SearchController::class, 'autoComplete'])->name('auto-complete');
Route::post('search', [SearchController::class, 'show'])->name('search');

// صفحة اختبار
Route::get('/test', function(){
    return view('details');
});

// التقييمات والإعجابات
Route::post('review', [ReviewController::class, 'store'])->name('review.store');
Route::post('like', [LikeController::class, 'store'])->name('like.store');

// راوتات لوحة التحكم (أدمن)
Route::middleware([RoleMiddleware::class.':1'])->prefix('admin')->group(function(){
    Route::get('/place/create', [PlaceController::class, 'create'])->name('place.create');
    Route::post('place/store', [PlaceController::class, 'store'])->name('place.store');
});

Route::get('/{place}/{slug}', [PlaceController::class, 'show'])->name('place.show');
Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');