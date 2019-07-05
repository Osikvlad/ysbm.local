<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GuzzleController@login');
Route::get('/login', 'GuzzleController@getApiData');
Route::get('/shipment', 'GuzzleController@getShipment');
Route::match(['GET','POST'], '/create_shipment', 'GuzzleController@createShipment');
Route::match(['GET','POST'], '/createshipment', 'GuzzleController@createShipmentView');
Route::match(['GET','POST'], '/deleteshipment', 'GuzzleController@deleteShipment');
Route::match(['GET','POST'], '/updateshipment/{id}', 'GuzzleController@updateShipmentView');
Route::match(['GET','POST'], '/update_shipment', 'GuzzleController@updateShipment');
Route::match(['GET','POST'], '/createitem', 'GuzzleController@createItemView');
Route::match(['GET','POST'], '/create_item', 'GuzzleController@createItem');
Route::match(['GET','POST'], '/shipment/{id}', 'GuzzleController@getShipmentInner');
Route::match(['GET','POST'], '/deleteitem', 'GuzzleController@deleteItem');


