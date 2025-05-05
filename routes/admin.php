<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function(){
    return 'Hello Admin';
})->name('dashboard');

Route::get('/courses', function(){
    return 'Courses';
})->name('courses');