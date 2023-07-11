<?php

use App\Models\Event;
use App\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // php artisan make:migration create_category_event_table --create category_event


    // $comp = \App\Models\Company::first();
    // $user = \App\User::first();
    // $user->companies()->sync([1]);
    // dd($user);

    return "<br><h1>Hello</h1>";
});
