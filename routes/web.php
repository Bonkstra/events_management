<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    debug("hello world", 1);
});
