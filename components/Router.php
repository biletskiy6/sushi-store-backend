<?php
class Router
{
    private $routes;

    public function __construct()
    {
        $includeRoutes = ROOT.'/config/routes.php';
        $this->routes = include($includeRoutes);
    }
    private function getURI()
    {
        if(!empty($_SERVER["REQUEST_URI"])){
            return trim($_SERVER["REQUEST_URI"], '/');
        }

    }
    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path){
            if(preg_match("~^$uriPattern~",$uri)){
                // echo("0");
                $internalRoute = preg_replace("~^$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parametrs = $segments;

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                 include_once($controllerFile);
             }

             $controllerObject = new $controllerName;
             $result = call_user_func_array(array($controllerObject, $actionName), $parametrs);

             if($result!=null)
                 break;
         }
     }
 }
}