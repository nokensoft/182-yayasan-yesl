<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Dashboard\AlbumController as DashboardAlbumController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\PhotoController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
| Halaman publik
*/
Route::middleware('track.visitor')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/galeri/{album:slug}', [GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/kebijakan-privasi', [PageController::class, 'privacy'])->name('pages.privacy');
    Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
    Route::get('/peta-situs', [PageController::class, 'sitemap'])->name('pages.sitemap');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /dashboard',
        'Disallow: /login',
        '',
        'Sitemap: '.url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines))->header('Content-Type', 'text/plain');
})->name('robots');

/*
| Autentikasi
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
| Dashboard (admin & operator)
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('dashboard.')->group(function () {
        Route::view('docs', 'dashboard.docs')->name('docs');

        Route::get('posts/trash', [DashboardPostController::class, 'trash'])->name('posts.trash');
        Route::patch('posts/{id}/restore', [DashboardPostController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/{id}/force', [DashboardPostController::class, 'forceDelete'])->name('posts.force-delete');
        Route::resource('posts', DashboardPostController::class)->except('show');

        Route::get('albums/trash', [DashboardAlbumController::class, 'trash'])->name('albums.trash');
        Route::patch('albums/{id}/restore', [DashboardAlbumController::class, 'restore'])->name('albums.restore');
        Route::delete('albums/{id}/force', [DashboardAlbumController::class, 'forceDelete'])->name('albums.force-delete');
        Route::resource('albums', DashboardAlbumController::class)->except('show');

        Route::resource('categories', DashboardCategoryController::class)->except('show');

        Route::post('albums/{album}/photos', [PhotoController::class, 'store'])->name('albums.photos.store');
        Route::delete('albums/{album}/photos/{photo}', [PhotoController::class, 'destroy'])->name('albums.photos.destroy');

        Route::post('media', [MediaController::class, 'upload'])->name('media.upload');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        Route::resource('users', DashboardUserController::class)->except('show')->middleware('role:admin');
    });
});
