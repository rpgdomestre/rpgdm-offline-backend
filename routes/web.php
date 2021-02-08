<?php

use App\Http\Controllers\Dashboard\CollectionsIndex;
use App\Http\Controllers\Dashboard\CollectionsPublish;
use App\Http\Controllers\Dashboard\LinksEdit;
use App\Http\Controllers\Dashboard\LinksStore;
use App\Http\Controllers\Dashboard\LinksCreate;
use App\Http\Controllers\Dashboard\LinksDelete;
use App\Http\Controllers\Dashboard\LinksUpdate;
use App\Http\Controllers\Dashboard\PagesIndex;
use App\Http\Controllers\Dashboard\PagesPublish;
use App\Http\Controllers\Dashboard\WeekliesEdit;
use App\Http\Controllers\Dashboard\SectionsStore;
use App\Http\Controllers\Dashboard\WeekliesIndex;
use App\Http\Controllers\Dashboard\WeekliesStore;
use App\Http\Controllers\Dashboard\SectionsCreate;
use App\Http\Controllers\Dashboard\WeekliesCreate;
use App\Http\Controllers\Dashboard\WeekliesUpdate;
use App\Http\Controllers\Dashboard\SourceTwitterStore;
use App\Http\Controllers\Dashboard\SourceTwitterCreate;
use App\Http\Controllers\Dashboard\WeekliesBuild;
use App\Http\Controllers\Dashboard\WeekliesBuildSingle;
use App\Http\Controllers\Dashboard\WeekliesGenerateTwitter;
use App\Http\Controllers\Dashboard\WeekliesGenerateMarkdown;
use App\Http\Controllers\Dashboard\WeekliesPublish;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::prefix('dashboard')
    ->middleware(['local'])
    ->group(static function () {
        Route::get('/', fn () => view('dashboard'))->name('dashboard.index');

        Route::get('/weeklies', WeekliesIndex::class)->name('weeklies.index');
        Route::get('/weeklies/create', WeekliesCreate::class)->name('weeklies.create');
        Route::post('/weeklies', WeekliesStore::class)->name('weeklies.store');
        Route::get('/weeklies/{weekly}/edit', WeekliesEdit::class)->name('weeklies.edit');
        Route::put('/weeklies/{weekly}', WeekliesUpdate::class)->name('weeklies.update');
        Route::patch('/weeklies/{weekly}', WeekliesUpdate::class);

        Route::get('/weeklies/{weekly}/markdown', WeekliesGenerateMarkdown::class)->name('weeklies.markdown');
        Route::get('/weeklies/{weekly}/twitter', WeekliesGenerateTwitter::class)->name('weeklies.twitter');
        Route::post('/weeklies/build', WeekliesBuild::class)->name('weeklies.build');
        Route::post('/weeklies/build/{weekly}', WeekliesBuildSingle::class)->name('weeklies.build.single');
        Route::post('/weeklies/publish', WeekliesPublish::class)->name('weeklies.publish');
        Route::post('/weeklies/publish/{weekly}', WeekliesPublish::class)->name('weeklies.publish.single');

        Route::get('/links/create', LinksCreate::class)->name('links.create');
        Route::post('/links', LinksStore::class)->name('links.store');
        Route::get('/links/{link}/edit', LinksEdit::class)->name('links.edit');
        Route::put('/links/{link}', LinksUpdate::class)->name('links.update');
        Route::patch('/links/{link}', LinksUpdate::class);
        Route::delete('/links/{link}', LinksDelete::class)->name('links.destroy');

        Route::get('/links/sections/create', SectionsCreate::class)->name('sections.create');
        Route::post('/links/sections', SectionsStore::class)->name('sections.store');

        Route::get('/links/sources/twitter', SourceTwitterCreate::class)->name('sources.twitter.create');
        Route::post('/links/sources/twitter', SourceTwitterStore::class)->name('sources.twitter.store');

        Route::get('/pages', PagesIndex::class)->name('pages.index');
        Route::post('/pages/publish', PagesPublish::class)->name('pages.publish');

        Route::get('/collections', CollectionsIndex::class)->name('collections.index');
        Route::post('/collections/publish', CollectionsPublish::class)->name('collections.publish');
    });
