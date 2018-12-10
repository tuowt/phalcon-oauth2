<?php

$router = $di->getRouter();

// Define your routes here
$router->setDefaultModule("admin");

$router->add("/:module/:controller/:action", [
    'module'     => 1,
    'controller' => 2,
    'action'     => 3
]);


$router->handle();
