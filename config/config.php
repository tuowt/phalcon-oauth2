<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

try {
    $oneMonthInterval = new \DateInterval('P1M');
    $oneHourInterval = new \DateInterval('PT1H');
    $tenMinutesInterval = new \DateInterval('PT10M');
} catch (Exception $e) {
}

return new \Phalcon\Config([
    'database'    => [
        'adapter'  => 'Mysql',
        'host'     => 'mysql',
        'username' => 'root',
        'password' => 'root',
        'dbname'   => 'oauth2',
        'charset'  => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'logsDir'        => BASE_PATH . '/storage/logs/',
        'migrationsDir'  => BASE_PATH . '/migrations/',
        'cacheDir'       => BASE_PATH . '/storage/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => '/',
    ],
    'appParams'   => [
        'appNamespace' => 'App',
        'appName'      => 'Padlock! The Phalcon Authentication Server',
        'appVersion'   => '0.1',
        'log' => [
            'level' => 'debug',
            'file' => BASE_PATH . '/storage/logs/wxpay.log',
        ],
    ],
    'oauth'       => [
        'refresh_token_lifespan'       => $oneMonthInterval,
        'access_token_lifespan'        => $oneMonthInterval,
        'auth_code_lifespan'           => $tenMinutesInterval,
        'always_include_client_scopes' => true,
        'public_key_path'              => BASE_PATH . '/config/oauth-key/public.key',
        'private_key_path'             => BASE_PATH . '/config/oauth-key/private.key',
    ],
    'debug'       => true,
]);
