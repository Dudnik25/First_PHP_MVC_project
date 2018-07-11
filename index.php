<?php
    error_reporting (E_ALL);
    if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('PHP5.1 Only'); }

    define ('DIRSEP', DIRECTORY_SEPARATOR);
    $site_path = $_SERVER['REQUEST_URI'];
    define ('site_path', $site_path);

    function __autoload( $className ) {
        $className = str_replace("..", "", $className);
        $classPath = str_replace('\\', '/',  $className .'.php');
        if (file_exists($classPath)) {
            require_once($classPath);
        }
    }

    require_once ('engine/config/config.php');
    require_once('engine/libs/rb.php');

    use engine\core\Router;

    session_start();
    $db = R::setup( 'mysql:host=localhost;dbname=uccidb','root', '' );

    $router = new Router();
    $router->run();
    exit();

?>