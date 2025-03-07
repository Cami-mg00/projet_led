<?php
require_once 'autoload.php';

class Router {
    public function handleRequest() {
        $controller = $_GET['controller'] ?? 'user';
        $action = $_GET['action'] ?? 'list';

        $controllerName = ucfirst($controller) . 'Controller';
        $controllerFile = __DIR__ . "/../controllers/{$controllerName}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controllerName();

            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                echo "Action non trouvée.";
            }
        } else {
            echo "Contrôleur non trouvé.";
        }
    }
}
$router = new Router();
$router->handleRequest();
?>
