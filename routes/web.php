<?php

use App\Http\Controllers\BrowseByDateController;
use App\Http\Controllers\BrowseByDomainController;
use App\Http\Controllers\BrowseBySubjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DisplayRelatedContentUnits;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubjectDetailController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('search', [SearchController::class, 'index'])->name('search');
Route::get('display', [DisplayRelatedContentUnits::class, 'index'])->name('display');
Route::get('browse/date', [BrowseByDateController::class, 'index'])->name('browse.date');
Route::post('browse/date', [BrowseByDateController::class, 'post'])->name('browse.date.post');
Route::get('browse/domain', [BrowseByDomainController::class, 'index'])->name('browse.domain');
Route::post('browse/domain', [BrowseByDomainController::class, 'post'])->name('browse.domain.post');
Route::get('browse/subject', [BrowseBySubjectController::class, 'index'])->name('browse.subject');
Route::post('browse/subject', [BrowseBySubjectController::class, 'post'])->name('browse.subject.post');
Route::get('subject-detail/{uri}', [SubjectDetailController::class, 'index'])->name('subject-detail');
Route::get('detail/{uri}', [DetailController::class, 'index'])->name('detail');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact.post');
Route::get('about', [UtilityController::class, 'about'])->name('about');
Route::get('help', [UtilityController::class, 'help'])->name('help');
Route::get('feed.rss', [FeedController::class, 'rss'])->name('rss');
Route::get('getParents', [BrowseBySubjectController::class, 'getParents'])->name('getParents');
Route::get('getChildren/{child}/{parent?}/', [BrowseBySubjectController::class, 'getChildren'])->name('getChildren');
