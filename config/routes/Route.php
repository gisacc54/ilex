<?php
namespace Config\Routes;


use App\HTTP\Controller\HomeController;
class Route{
  public static $routes=[];

  public static function get($action,$callback)
  {
    $action = trim($action,'/');

    self::$routes[$action] = $callback;
  }



  public static function dispatch($action)
  {
    $action=trim($action,'/');
    if(self::emptyCallback($action))
      return;
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
              \print_r( $classObject->$method());
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
          // @$className = substr($callback,0,$index);
          $error = "ERROR::Worng Syntax ";
          $message ="";
          self::onError($error,$message);
        }

      }
      elseif(gettype($callback)=='object'){
        \print_r(call_user_func($callback));
      }
      else{
        $error = "ERROR:: Worng Route parameters";
        $message ="Notice: Worng parameters require string or callback function ";
        self::onError($error,$message);
      }



  }

  protected function emptyCallback($action){
    if(!isset(self::$routes[$action])){
      $error = "ERROR:: Undifine route";
      $message ="Notice: Undefined offset: $action in /opt/lampp/htdocs/class/php/project/ilex/config/routes/Route.php";
      self::onError($error,$message);
      return true;
    }

    return false;
  }
  protected function onError($error,$message)
  {

    require_once "Exceptions/error.php";
  }

}
