<?php
use Config\Routes\Route;

Route::get('/', function()
{
  return "ilex Framework";
});
Route::get('/home', 'HomeController@index');
// route('/',function (){
//   return "ilex Framework";
// });
// route('about',function (){
//   return "All about ilex Framework";
// });
