<?php

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

Auth::routes();

//Auth protected routes
Route::middleware('auth')->group(function () {
    //Swimmers
    Route::get('/swimmers', 'SwimmerController@index');
    Route::get('/swimmers/{id}', 'SwimmerController@show');
    Route::delete('/swimmers/{id}', 'SwimmerController@destroy');
    Route::get('/swimmers/{id}/edit', 'SwimmerController@edit');
    Route::patch('/swimmers/{id}/edit', 'SwimmerController@update');

    /* @see DashboardController::index() */
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/analytics', 'DashboardController@analytics');
    Route::get('/dashboard/season/current', 'DashboardController@swimmersForCurrentSeason');

    /* @see PrivateLessonLeadController::show() */
    Route::get('/private-semi-private/lead/{id}', 'PrivateLessonLeadController@show');

    /* @see LeadController::show() */
    Route::get('/lead/{lead}', 'LeadController@show');

    /* @see GroupController */
    Route::resource('groups', 'GroupController');
    /* @see LocationController */
    Route::resource('locations', 'LocationController');
    /* @see LessonController */
    Route::resource('lesson', 'LessonController');

    /* @see TryoutController */
    Route::resource('tryouts', 'TryoutController');

    /* @see AthleteController */
    Route::resource('athlete', 'AthleteController');

    /* @see WaitListController::show() */
    Route::get('/wait-list/{id}', 'WaitListController@show');

    Route::post('/lesson-link-email/{id}', 'LessonController@emailSignUpLink');

    /* @see AthleteController::youMadeTheTeamEmail() */
    Route::post('/swim-team/congrats-email', 'AthleteController@youMadeTheTeamEmail');
});


/*
 * Home page
 */

Route::get('/', 'HomeController@index');

/*
 * Group Lessons
 */

//List lessons
/* @see GroupController::index() */
Route::get('/lessons', 'GroupController@index');

//List details of the lesson
/* @see GroupController::classDetails() */
Route::get('/lessons/{group}', 'GroupController@classDetails');

//Sign up form for that lesson
/* @see GroupController::signUp() */
Route::get('/lessons/{group}/{lesson}', 'GroupController@signUp');

//Save the results of the sign up form
/* @see SwimmerController::store() */
Route::post('/lessons/{classType}/{id}', 'SwimmerController@store');




/*
 * Wait List
 */
/* @see WaitListController::store() */
Route::post('/wait-list/{id}', 'WaitListController@store');




/*
 * Swim Team Tryouts
 */

//The Link to see all tryouts
/* @see TryoutController::index() */
Route::get('/swim-team/tryouts', 'TryoutController@index');

//The Link to sign up for a tryout
/* @see TryoutController::signUp() */
Route::get('/swim-team/tryouts/{id}', 'TryoutController@signUp');

//Save the results of the sign up form
/* @see AthleteController::store() */
Route::post('/swim-team/tryouts/{id}', 'AthleteController@store');




/*
 * Swim Team Registration
 */

/* @see STSwimmerController::index() */
Route::get('/swim-team/signup/{id}', 'STSwimmerController@index');

/* @see STSwimmerController::store() */
Route::post('/swim-team/signup/{id}', 'STSwimmerController@store');

/* @see STSwimmerController::checkout() */
Route::get('/swim-team/checkout/{id}', 'STSwimmerController@checkout');

/* @see STSwimmerController::pay() */
Route::post('/swim-team/checkout', 'STSwimmerController@pay');

/* @see STSwimmerController::roster() */
Route::get('/roster', 'STSwimmerController@roster');




/*
 * Public Contact Forms
 */

/* @see LeadController::store() */
Route::post('/contact-us', 'LeadController@store');

/* @see LeadController::store() */
Route::post('/lifeguarding', 'LeadController@store');

/* @see LeadController::store() */
Route::post('/cpr-first-aid', 'LeadController@store');

/* @see PrivateLessonLeadController::store() */
Route::post('/private-semi-private', 'PrivateLessonLeadController@store');




/*
 * Email marketing unsubscribe page
 */

/* @see EmailListController::unsubscribe() */
Route::get('/unsubscribe/{email}', 'EmailListController@unsubscribe');




/*
 * Static Pages
 */

Route::get('/services', function(){
    return view('pages.services');
});

Route::get('/swim-team', function(){
    return view('swim-team.swim-team');
});

Route::get('/about', function(){
    return view('pages.about');
});

Route::get('/testimonials', function(){
    return view('pages.testimonials');
});

Route::get('/contact-us', function(){
    return view('pages.contact-us');
});

Route::get('/other-services', function (){
    return view('pages.other-services');
});

Route::get('/lifeguarding', function (){
    return view('pages.lifeguarding');
});

Route::get('/cpr-first-aid', function(){
    return view('pages.cpr-first-aid');
});

Route::get('/group-lessons/policies-and-procedures', function(){
    return view('groups.terms');
});

Route::get('/swim-team/policies-and-procedures', function(){
    return view('swim-team.terms');
});

Route::get('/private-semi-private', function () {
    return view('private-lesson-leads.index');
});