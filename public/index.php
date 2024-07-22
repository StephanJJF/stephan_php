<?php 
require_once "../vendor/autoload.php";
$uri = $_SERVER["REQUEST_URI"];
$router = new AltoRouter();

require_once "../config/routes.php";

$match = $router->match();
if (is_array($match)) {
    if (is_callable($match["target"])) {
        call_user_func_array($match["target"], $match["params"]);
    } else {
        $params = $match["params"];
        ob_start();
        require_once "../templates/" . $match["target"] . ".php";
        $pageContent = ob_get_clean();
    }
} else {
    ob_start();
    require_once "../templates/error404.php";
    $pageContent = ob_get_clean();
}
require_once "../elements/layout.php";
