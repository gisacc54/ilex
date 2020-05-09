<?php
namespace Config\Controller;
/*
|--------------------------------------------------------------------------
| Route                   @ created by Gift Isacc
|--------------------------------------------------------------------------
|
*/
class Controller {
  public $variable;
  public function view($view,$data = [])
  {
    if(!$this->chek_view($view))
      return;
      if(!$this->is_array($data))
        return;


      include "resource/views/$view.php";
      return;



  }

  public function push($valiables =[])
  {
    $obj=$this;
    $obj->variable=$valiables;
    return $obj;
  }

  protected function is_array($data)
  {
    if(\gettype($data) == 'array')
    {
      return true;
    }

      $error="";
      $message='<b>Warning</b>:  Parameter must be an array or an object that implements Countable in <b>/opt/lampp/htdocs/class/php/project/ilex/config/controller/Controller.php</b>';
      $this->error($error,$message);
      return false;
  }

  protected function chek_view($view)
  {
    if(file_exists("resource/views/$view.php"))
      return true;

    $error = "<Strong> ERROR : :</Strong> View is note Found";
    $message ="File resource/views/$view.php is not Found. Pleas create view file in 'resource/views/' directory ";
    $this->error($error,$message);
    return false;
  }

  protected function error($error,$message)
  {
    include "Exceptions/error.php";
    return;
  }

  public function more($valiables)
  {
    $obj=$this;
    $obj->variable=$valiables;
    return $obj;
  }

}
