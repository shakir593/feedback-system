<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, FeedbackController};

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
        Route::get('/view-profile', 'viewProfile')->name('viewProfile');
        Route::get('email','email')->name('email');
        Route::get('/company', 'company')->name('company');

    });
     Route::controller(FeedbackController::class)->group(function () {
        Route::get('/feedbacks', 'index')->name('feedback.index');
        Route::get('/feedback/create', 'create')->name('feedback.create');
        Route::post('/feedback/store', 'store')->name('feedback.store');
        Route::get('/feedback/{id}', 'show')->name('feedback.show');
        Route::get('/feedback/edit/{id}', 'edit')->name('feedback.edit');
        Route::post('/feedback/update/{id}', 'update')->name('feedback.update');
        Route::post('/feedback/delete/{id}', 'destroy')->name('feedback.delete');
        Route::get('/feedback/{id}/comment/add', 'add_feedback_comment')->name('feedback.add_comment');
        Route::post('/feedback/{id}/comment/save', 'save_comment')->name('feedback.save_comment');
        Route::post('/feedback/{feedback_id}/comment/{comment_id}/delete', 'delete_comment')->name('feedback.delete_comment');
        Route::get('/fetch-user', 'fetch_user')->name('fetch_user');

    });
     Route::controller(DashboardController::class)->group(function () {
        Route::get('/feedback-categories', 'feedback_categories')->name('feedback-category.index');
    });
});

Auth::routes();
