<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('projects', 'ProjectController');

Route::get('/projects/{slug}', 'ProjectController@showSlug')->where('slug', '[A-Za-z-]+');