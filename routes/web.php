<?php

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
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('search', 'SearchController@index')->name('search');
Route::get('display', 'DisplayRelatedContentUnits@index')->name('display');
Route::get('browse/date', 'BrowseByDateController@index')->name('browse.date');
Route::post('browse/date', 'BrowseByDateController@post')->name('browse.date.post');
Route::get('browse/domain', 'BrowseByDomainController@index')->name('browse.domain');
Route::post('browse/domain', 'BrowseByDomainController@post')->name('browse.domain.post');
Route::get('browse/subject', 'BrowseBySubjectController@index')->name('browse.subject');
Route::post('browse/subject', 'BrowseBySubjectController@post')->name('browse.subject.post');
Route::get('subject-detail/{uri}', 'SubjectDetailController@index')->name('subject-detail');
Route::get('detail/{uri}', 'DetailController@index')->name('detail');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact', 'ContactController@store')->name('contact.post');
Route::get('about', 'UtilityController@about')->name('about');
Route::get('help', 'UtilityController@help')->name('help');
Route::get('feed.rss', 'FeedController@rss')->name('rss');
Route::get('getParents', 'BrowseBySubjectController@getParents')->name('getParents');
Route::get('getChildren/{child}/{parent?}/', 'BrowseBySubjectController@getChildren')->name('getChildren');
