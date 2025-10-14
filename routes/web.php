<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\MessageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/projects/{id}', [PageController::class, 'projectShow'])->name('projects.show');

Route::get('/education', [PageController::class, 'education'])->name('education');
Route::get('/experience', [PageController::class, 'experience'])->name('experience');
Route::get('/skills', [PageController::class, 'skills'])->name('skills');

Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [PageController::class, 'blogShow'])->name('blog.show');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

