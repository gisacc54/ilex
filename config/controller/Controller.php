<?php
namespace Config\Controller;
/*
$this->more(['users'=>$users])->view('welcome'); view with parameters in controller files
*/
class Controller {
  public $variable;
  public function view($view)
  {
    if(file_exists("resource/views/$view.php") ){
      include "resource/views/$view.php";
      return;
    }
    else {
      $error = "<Strong> ERROR : :</Strong> View is note Found";
      $message ="File resource/views/$view.php is not Found. Pleas create view file in 'resource/views/' directory ";

      // include "Exceptions/error.php";

      include "Exceptions/error.php";
      return;
    }

  }

  public function more($valiables)
  {
    $obj=$this;
    $obj->variable=$valiables;
    return $obj;
  }

}
