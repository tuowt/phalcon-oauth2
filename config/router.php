<?php

$router = $di->getRouter();

// Define your routes here
$router->setDefaultModule("oauth2");

$router->add("/:module/:controller/:action", [
    'module'     => 1,
    'controller' => 2,
    'action'     => 3
]);


$router->handle();
