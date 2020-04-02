<?php

Route::group(['module' => 'Reports', 'middleware' => ['web'], 'namespace' => 'App\Modules\Reports\Controllers'], function() {

    Route::resource('Reports', 'ReportsController');

});
