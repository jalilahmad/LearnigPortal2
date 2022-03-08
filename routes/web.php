<?php

use App\Course;
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

Route::get('/', function () {
    
   
    
        return view('first');
})->name('home');

Auth::routes();
Route::post('/register','Auth\RegisterController@register')->name('register');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('courses', 'CourseController');
Route::get('coures/{id}','CourseController@tagsView')->name('tag.course');
Route::post('update-profile','UserController@update')->name('update.profile');


//teacher routes
Route::group(['middleware' => 'role:teacher'], function(){
Route::get('/create-step-one', 'CourseController@CreateStepOne');
Route::post('/create-step-one', 'CourseController@StoreStepOne');

Route::get('/create-step-two', 'CourseController@CreateStepTwo');
Route::post('/create-step-two', 'CourseController@StoreStepTwo');
Route::post('/remove-image', 'CourseController@RemoveImage');

Route::get('/create-step-three', 'CourseController@CreateStepThree');
Route::post('/create-step-three', 'CourseController@store');
Route::get('/my-courses', 'CourseController@indexMycourses');
Route::get('/add-episode/{id}','CourseController@addEpisode')->name('add.episode');
Route::post('/add-episode/{id}', 'CourseController@storeNewEpisode')->name('store.add.episode');
});
Route::get('/episodes/{id}', 'CourseController@show')->name('course.show');
Route::post('/search', 'HomeController@search')->name('search');


//Admin routes
Route::group(['middleware'=> 'role:admin'], function(){
    Route::resource('users','UserController');
    Route::get('/teachers-list', 'UserController@indexTeachers')->name('teachers.index');
    Route::get('/learners-list', 'UserController@indexLearners')->name('learners.index');
    Route::get('teachers-list/{id}/edit/','UserController@edit');
    Route::get('learners-list/{id}/edit/','UserController@edit');
    Route::post('/teachers-list', 'UserController@store')->name('teachers.store');
    Route::post('/learners-list', 'UserController@store')->name('learners.store');
    Route::post('/episodes/{id}', 'CourseController@approveEpisode')->name('episode.approve');
    Route::resource('admincourses', 'AdminCourseController');
    Route::resource('episodelist', 'EpisodeController');
    Route::get('/unapprovedepisodeslist', 'EpisodeController@unapprovedEpisodes')->name('unapproved.episodes');
    Route::get('approve-episode','EpisodeController@approveEpisode');
}); 

//learner routes
Route::group(['middleware'=> 'role:learner'], function(){
    Route::get('episodes/{uuid}/download', 'CourseController@download')->name('episode.download');
    Route::get('courses/subscribe', 'CourseController@Subscribe')->name('course.subscribe');
    Route::get('/bookmarks', 'CourseController@showBookmarkedCourses');
    Route::post('/bookmark-course/{id}','CourseController@BookmarkCourse')->name('bookmark');
    Route::get('/watchlist', 'CourseController@watchlist');
    Route::post('add-to-watchlist/{id}', 'CourseController@addToWatchlist')->name('add.watchlist');
    Route::post('remove-bookmark','CourseController@removeBookmark')->name('remove.bookmark');


});

//teacher page route
Route::get('/teachers', 'UserController@ShowTeachers');


//Comment routes
Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');





//dashboard routes

Route::get('/teacher-table','DashboardController@loadTeacherTable');
Route::get('/learner-table','DashboardController@loadLearnerTable');
Route::get('/course-table','DashboardController@loadCourseTable');
Route::get('/episode-table','DashboardController@loadEpisodeTable');
Route::get('/unapproved-table','DashboardController@loadUnapprovedTable');

