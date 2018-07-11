<?php

namespace engine\core;



class Router {

    protected $routes;
    protected $post_routes;
    protected $params;
    protected $first_arg;

    function __construct(){
        $arr = require 'engine/config/routes.php';
        $arr2 = require 'engine/config/post_routes.php';
        foreach ($arr as $key => $val) {
            $this->add('routes', $key, $val);
        }
        foreach ($arr2 as $key => $val) {
            $this->add('post_routes', $key, $val);
        }
    }

    private function add($type, $route, $params) {
        $route = '#^'. $route .'$#';
        $this->$type[$route] = $params;
    }

    private function mutch() {
        if (isset($_POST['action'])) {
            $url = $_POST['action'];
            $rout = $this->post_routes;
        } else {
            $url = trim(str_replace('/portal/', '', $_SERVER['REQUEST_URI']), '/');
            $rout = $this->routes;
        }
            foreach ($rout as $route => $params) {
                if (preg_match($route, $url, $matches)) {
                    $this->params = $params;
                    $this->first_arg = preg_replace($route, '$1', $url);
                    return true;
                }
            }
            return false;
        }

    public function run() {
        if ($this->mutch()) {
            $patch = 'engine\controller\\'. ucfirst($this->params['controller']). 'Controller';
            if (class_exists($patch)) {
                $class = $this->params['action']. 'Action';
                if (method_exists($patch, $class)) {
                    $controller = new $patch($this->params);
                    $controller->$class($this->first_arg);
                } else {
                    echo 'Не найден метод: ' . $class;
                }
            } else {
                echo 'Не найден контролер: ' . $patch;
            }
        } else {
            echo 'Маршрут не найден';
        }
    }

//    public function postRequest() {
//        if ($this->post_mutch()) {
//            $patch = 'engine\controller\\'. ucfirst($this->post_params['controller']). 'Controller';
//            if (class_exists($patch)) {
//                $class = $this->post_params['action']. 'Action';
//                if (method_exists($patch, $class)) {
//                    $controller = new $patch($this->params);
//                    $controller->$class();
//                } else {
//                    echo 'Не найден метод: ' . $class;
//                }
//            } else {
//                echo 'Не найден контролер: ' . $patch;
//            }
//        } else {
//            echo 'Ой что-то пошло не так';
//        }
//    }

}