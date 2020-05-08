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
    $callback = self::$routes[$action];

    if(gettype($callback)=='string')
    {
      if($index = strpos($callback, "@"))
      {
        $className = substr($callback,0,$index);
        $method = substr($callback,++$index);
        $class = "App\HTTP\Controller\\".$className;
        $classObject =new $class();
        echo $classObject->$method();
      }
      else {
        echo("ERROR:: Undifined Controller");
      }

    }
    elseif(gettype($callback)=='object'){
      echo call_user_func($callback);
    }
    else
      echo "ERROR:: Worng Route parameter";
  }

}
