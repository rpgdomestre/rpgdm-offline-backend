<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/home');
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(static function () {
    Route::get('/links', 'LinksIndex')->name('links.index');
    Route::get('/links/create', 'LinksCreate')->name('links.create');
    Route::post('/links', 'LinksStore')->name('links.store');
    Route::get('/links/{link}/edit', 'LinksEdit')->name('links.edit');
    Route::put('/links/{link}', 'LinksUpdate')->name('links.update');
    Route::patch('/links/{link}', 'LinksUpdate');

    Route::get('/weeklies', 'WeekliesIndex')->name('weeklies.index');
    Route::get('/weeklies/create', 'WeekliesCreate')->name('weeklies.create');
    Route::post('/weeklies', 'WeekliesStore')->name('weeklies.store');
    Route::get('/weeklies/{weekly}/edit', 'WeekliesEdit')->name('weeklies.edit');
    Route::put('/weeklies/{weekly}', 'WeekliesUpdate')->name('weeklies.update');
    Route::patch('/weeklies/{weekly}', 'WeekliesUpdate');

    Route::get('/weeklies/{weekly}/markdown', 'WeekliesGenerateMarkdown')->name('weeklies.markdown');
});

