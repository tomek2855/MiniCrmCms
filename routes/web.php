<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/seed', function() {
    Artisan::call('storage:link');
    Artisan::call('db:seed');
    echo 'ok';
});

Route::namespace('Web')->group(function() {
    Route::get('/', 'PagesController@getHome');
    Route::get('/formularz-zgloszeniowy', 'PagesController@getCourseForm');

    /* Formularze */
    Route::post('/formularz-kontaktowy', 'FormController@postContact');
    Route::post('/formularz-zgloszeniowy', 'FormController@postCourse');
});

Route::namespace('Admin')->prefix('admin')->group(function() {
    Route::get('/login', 'LoginController@index')->name('admin.login');
    Route::post('/login', 'LoginController@postLogin');
    Route::get('/logout', 'LoginController@logout');

    // Need to be login
    Route::middleware('auth', 'view.variables')->group(function() {
        Route::get('/', 'HomeController@index');

        Route::get('/forms/contacts', 'FormsController@getContacts');
        Route::get('/forms/contacts/edit/{id}', 'FormsController@getContact');
        Route::get('/forms/courses', 'FormsController@getCourses');
        Route::get('/forms/courses/edit/{id}', 'FormsController@getCourse');

        Route::get('/courses', 'CoursesController@index');
        Route::get('/courses/add', 'CoursesController@getAdd');
        Route::post('/courses/add', 'CoursesController@postAdd');
        Route::get('/courses/edit/{id}', 'CoursesController@getEdit');
        Route::post('/courses/edit/{id}', 'CoursesController@postEdit');
        Route::post('/courses/delete/{id}', 'CoursesController@postDelete');

        Route::namespace('Crm')->prefix('crm')->group(function () {
            Route::get('/clients', 'ClientsController@index');
            Route::get('/clients/add', 'ClientsController@getAdd');
            Route::post('/clients/add', 'ClientsController@postAdd');
            Route::get('/clients/edit/{id}', 'ClientsController@getEdit');
            Route::post('/clients/edit/{id}', 'ClientsController@postEdit');
            Route::post('/clients/delete/{id}', 'ClientsController@postDelete');

            Route::get('/courses', 'CoursesController@index');
            Route::get('/courses/add', 'CoursesController@getAdd');
            Route::post('/courses/add', 'CoursesController@postAdd');
            Route::get('/courses/edit/{id}', 'CoursesController@getEdit');
            Route::post('/courses/edit/{id}', 'CoursesController@postEdit');
            Route::post('/courses/delete/{id}', 'CoursesController@postDelete');

            Route::get('/clients/{client}/courses', 'ClientCoursesController@getCourses');
            Route::get('/courses/{course}/clients', 'ClientCoursesController@getClients');
        });
    });
});
