<?php

Route::get('/', 'FrontendController@frontpage');
Route::post('/contact/form/submit', 'FrontendController@contactformsubmit');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact/message/view', 'HomeController@contactmessageview');
Route::get('/contact/message/delete/{message_id}', 'HomeController@contactmessagedelete');
Route::get('/contact/message/markasread/{message_id}', 'HomeController@contactmessagemarkasread');
Route::get('/contact/message/edit/{message_id}', 'HomeController@contactmessageedit');
Route::post('/contact/message/update', 'HomeController@contactmessageupdate');
Route::get('/contact/message/restore/{message_id}', 'HomeController@contactmessagerestore');

Route::get('/admin/about', 'HomeController@adminabout');
Route::post('/admin/about/insert', 'HomeController@adminaboutinsert');
Route::get('/admin/about/active/{about_id}', 'HomeController@adminaboutactive');
Route::get('/admin/about/edit/{about_id}', 'HomeController@adminaboutedit');
Route::post('/admin/about/update', 'HomeController@adminaboutupdate');
Route::post('/admin/about/point/insert', 'HomeController@adminaboutpointinsert');
Route::get('/admin/service', 'HomeController@adminservice');
Route::post('/admin/service/insert', 'HomeController@adminserviceinsert');
Route::get('/admin/service/deactive/{service_id}', 'HomeController@adminservicedeactive');
Route::get('/admin/service/active/{service_id}', 'HomeController@adminserviceactive');
