<?php

use app\core\Application;

require_once __DIR__."/vendor/autoload.php";

$app = new Application();

$app->router->get('/',function() {
    return "Home page ";
});
$app->router->get('/contact',function() {
    return "Contact ";
});

$app->run();