<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('projects', 'ProjectController');
Route::resource('api/links', 'API\LinkController');

Route::get('/projects/{slug}', 'ProjectController@showSlug')->where('slug', '[A-Za-z-]+');