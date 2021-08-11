<?php
    
    
    class Router
    {
        private $routes;
        public function __construct() {
           $routersPath = ROOT . '/config/routes.php';
           $this->routes = include($routersPath);
        }
    
        /**
         * Returns request string
         * @return string
         */
        private function getURI() {
            if (!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }
    
        /**
         * Функция загрузки страници
         */
        public function run() {
            // Получить строку запроса
            $uri = $this->getURI();
            
            // Проверить наличие такого запроса в routes.php
            foreach ($this->routes as $uriPattern => $path) {
                
                // Сравниваем $uriPattern и $uri
                if (preg_match("~$uriPattern~", $uri)) {
                    
                    // Получаєм внутриний путь из внешнего согласно правилу
                    $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                    
                    // Определяем какой контролер и action обрабативают запрос
                    $segments = explode('/', $internalRoute);
                    
                    $controllerName = array_shift($segments) . 'Controller';
                    $controllerName = ucfirst($controllerName);
                    
                    $actionName = array_shift($segments) . 'Action';
                    
                    $parameters =$segments;
                    
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                    
                    if (file_exists($controllerFile)) {
                        include_once ($controllerFile);
                    }
                    
                    // Создать оюект, визввать метод action
                    $controllerObject = new $controllerName;
    
                    //$result = mainFunction::loadPage($smarty, $controllerName, $actionName);
                    
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    
                    
                    
                    if ($result != null) {
                        break;
                    }
                }
            }
            
        }
    
    }