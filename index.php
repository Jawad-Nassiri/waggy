<?php

use Core\Router;

require_once 'core/Autoloader.php';
require_once 'config/database.php';


$router = new Router();
$router->dispatch();