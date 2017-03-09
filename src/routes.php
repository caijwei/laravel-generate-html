<?php
Route::get('', "PrivateController@refresh");
Route::post('callback', "PrivateController@callback");

