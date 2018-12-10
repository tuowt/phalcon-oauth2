<?php
return [
    'oauth2' => [
        'className' => "App\\Module\\OAuth2\\Module",
        'path'      => APP_PATH . '/modules/oauth2/Module.php',
    ],
    'mch'    => [
        'className' => "App\\Module\\Mch\\Module",
        'path'      => APP_PATH . '/modules/mch/Module.php',
    ],
    'admin'    => [
        'className' => "App\\Module\\Admin\\Module",
        'path'      => APP_PATH . '/modules/admin/Module.php',
    ],
    'api'    => [
        'className' => "App\\Module\\Api\\Module",
        'path'      => APP_PATH . '/modules/api/Module.php',
    ],
];
