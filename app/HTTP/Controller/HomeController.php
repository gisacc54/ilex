<?php
namespace App\HTTP\Controller;
/*
| ---------------------------------------------------------------------
| Home Controller        @ created by Gift Isacc
| ---------------------------------------------------------------------
|
|
| This is controller were all logic of your Application are wirten
|
|
*/
class HomeController extends Controller{
  public function index()
  {
    $users = ['name'=>'Gisacc Gos','email'=>'gisacc@gos.com'];
    return $this->view('welcome',['users'=>$users]);
  }
}
