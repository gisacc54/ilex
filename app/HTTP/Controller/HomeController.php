<?php
namespace App\HTTP\Controller;

class HomeController extends Controller{
  public function index()
  {
    return $this->view('welcome');
  }
}