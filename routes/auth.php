<?php

use Illuminate\Routing\Route;

Route::group(['prefix'=>'/auth'],function(){
    Route::get('admin/index','AdminController@index');
});