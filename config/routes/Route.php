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
    if(isset(self::$routes[$action]))
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
            echo $classObject->$method();
          }
          else{
            $error = "ERROR::Undifine Controller class ";
            $message ="Undifine Controller $class";
            include "Exceptions/error.php";
          }

        }
        else {
          // @$className = substr($callback,0,$index);
          $error = "ERROR::Worng Syntax ";
          $message ="";
          include "Exceptions/error.php";
        }

      }
      elseif(gettype($callback)=='object'){
        echo call_user_func($callback);
      }
      else{
        $error = "ERROR:: Worng Route parameters";
        $message ="Notice: Worng parameters require string or callback function ";
        include "Exceptions/error.php";
      }

    }
    else {
      $error = "ERROR:: Undifine route";
      $message ="Notice: Undefined offset: 878 in /opt/lampp/htdocs/class/php/project/ilex/config/routes/Route.php";
      include "Exceptions/error.php";
    }


  }

}
