<?php
namespace Config\Controller;

class Controller {
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
      include "storage/tamplete.php";
      return;
    }

  }

}
