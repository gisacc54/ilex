<?php
namespace Config\Routes;

use App\HTTP\Controller\HomeController;
/*
|--------------------------------------------------------------------------
| Route                   @ created by Gift Isacc
|--------------------------------------------------------------------------
|
*/

class Route{
  public static $routes=[];

  public static function get($action,$callback)
  {
    if(($start = strpos($action,'{')) && ($end = \strpos($action,'}')))
    {
      $action = \substr($action,0,$start).'{param}';
    }
    $action = trim($action,'/');

    self::$routes[$action] = $callback;
  }

// -------------------------------------------------------------------------------------

  public static function dispatch($action)
  {


    $action=trim($action,'/');
    if(self::emptyCallback($action))
      return;

    self::makeCallBack($action);
  }
                   // makeCallBack
// ---------------------------------------------------------------------------------
  protected function makeCallBack($action,$param = '')
  {
    $callback = self::$routes[$action];
      if(gettype($callback)=='string')
      {
        if($index = strpos($callback, "@"))
        {
          $className = substr($callback,0,$index);
          $method = substr($callback,++$index);
          $class = "App\HTTP\Controller\\".$className;

          if(class_exists($class))
          {
            $classObject =new $class();
            if(\method_exists($classObject,$method))
              \print_r( \call_user_func([$classObject,$method],$param));
            else
              {
                $error = "ERROR::Undifine Method";
                $message ="Undifine method $method from class : $class ";
                self::onError($error,$message);
              }
          }
          else{
            $error = "ERROR::Undifine Controller class ";
            $message ="Undifine Controller $class";
            self::onError($error,$message);
          }

        }
        else {
          $error = "ERROR::Worng Syntax ";
          $message ="";
          self::onError($error,$message);
        }

      }
      elseif(gettype($callback)=='object'){
        \print_r(call_user_func($callback,$param));
      }
      else{
        $error = "ERROR:: Worng Route parameters";
        $message ="Notice: Worng parameters require string or callback function ";
        self::onError($error,$message);
      }
  }

// --------------------------------------------------------------------------------------

  protected function emptyCallback($action){
    if(isset(self::$routes[$action])){

      return false;
    }
    elseif (self::checkActionParam($action)) {
      return true;
    }
    $error = "ERROR:: Undifine route";
    $message ="Notice: Undefined offset: $action in /opt/lampp/htdocs/class/php/project/ilex/config/routes/Route.php";
    self::onError($error,$message);
    return true;
  }

// --------------------------------------------------------------------------------------------------

  protected function checkActionParam($action)
  {
    if($index =strripos($action,'/'))
    {
      $param = \substr($action,$index+1);
      $action = \substr($action,0,$index+1)."{param}";
      if(isset(self::$routes[$action]))
      {
        self::makeCallBack($action,$param);
        return true;
      }
      return false;
    }

    return false;
  }



// ---------------------------------------------------------------------------------------------------


  protected function onError($error,$message)
  {

    require_once "Exceptions/error.php";
  }

}
