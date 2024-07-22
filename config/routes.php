<?php
$router->map("GET|POST", "/", "home", "_home");
$router->map("GET|POST", "/nous-contacter", "contact", "_contact");
$router->map("GET|POST", "/les-catalogues", "blog/index", "_catalogue");
$router->map("GET|POST", "/tableau-dynamique", "tableauDynamique", "_tableauDynamique");
$router->map("GET|POST", "/se-connecter", "connexion", "_connexion");
$router->map("GET|POST", "/user-page", "userPage", "_userPage");
$router->map("GET|POST", "/admin-page", "adminPage", "_adminPage");