<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-translation', function () {
    return __('module_names.emlpoyees.label');
    #return __('module_names.navigation_groups.administration');
});
