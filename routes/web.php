<?php

use App\Http\Controllers\SitemapController;
use EduLazaro\Larablog\Larablog;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Larablog::routes('blog');
