<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/10/17
 * Time: 9:09 AM
 */

namespace App\Module\OAuth2;

use App\Module\OAuth2\Plugin\NotFoundPlugin;
use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Events\Manager;
use App\Module\OAuth2\Library\Response;
use App\Module\OAuth2\Repository\AccessTokenRepository;
use App\Module\OAuth2\Repository\AuthCodeRepository;
use App\Module\OAuth2\Repository\ClientRepository;
use App\Module\OAuth2\Repository\RefreshTokenRepository;
use App\Module\OAuth2\Repository\ScopeRepository;
use App\Module\OAuth2\Repository\UserRepository;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null) {

        $di->get('Loader')->registerNamespaces([
            'App\\Module\\OAuth2\\Controller' => APP_PATH . '/modules/oauth2/controller',
            'App\\Module\\OAuth2\\Model'      => APP_PATH . '/modules/oauth2/model',
            'App\\Module\\OAuth2\\Library'    => APP_PATH . '/modules/oauth2/library',
            'App\\Module\\OAuth2\\Repository' => APP_PATH . '/modules/oauth2/repository',
            'App\\Module\\OAuth2\\CInterface' => APP_PATH . '/modules/oauth2/interfaces',
        ], true);

        $di->get('Loader')->register();
    }

    public function registerServices(DiInterface $di) {
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            //            $eventsManager = new Manager();
            //
            //            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin());
            //            $dispatcher->setEventsManager($eventsManager);

            $dispatcher->setDefaultNamespace('App\\Module\\OAuth2\\Controller');
            return $dispatcher;
        });

        $di->setShared('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(APP_PATH . '/modules/oauth2/views');

            $view->registerEngines([
                '.phtml' => PhpEngine::class,
            ]);

            return $view;
        });

        /**
         * Response Handler
         */
        $di['response'] = function () {
            return new Response();
        };

        $di->setShared('oauth2Server', function () {
            $config = $this->getConfig();

            $clientRepository = new ClientRepository();
            $scopeRepository = new ScopeRepository();
            $accessTokenRepository = new AccessTokenRepository();
            $userRepository = new UserRepository();
            $refreshTokenRepository = new RefreshTokenRepository();
            $authCodeRepository = new AuthCodeRepository();

            // Setup the authorization server
            $server = new \League\OAuth2\Server\AuthorizationServer(
                $clientRepository,
                $accessTokenRepository,
                $scopeRepository,
                new \League\OAuth2\Server\CryptKey($config->oauth->private_key_path),
                'RgXloVLeRUBVrGpqOvWPsRL9LlSoLbZfCuaroDoJF1s='
            );

            $passwordGrant = new \League\OAuth2\Server\Grant\PasswordGrant($userRepository, $refreshTokenRepository);
            $passwordGrant->setRefreshTokenTTL($config->oauth->refresh_token_lifespan);

            $authCodeGrant = new AuthCodeGrant(
                $authCodeRepository,
                $refreshTokenRepository,
                $config->oauth->auth_code_lifespan
            );

            $refreshTokenGrant = new \League\OAuth2\Server\Grant\RefreshTokenGrant($refreshTokenRepository);
            $refreshTokenGrant->setRefreshTokenTTL($config->oauth->refresh_token_lifespan);

            // Enable the refresh token grant on the server
            $server->enableGrantType($refreshTokenGrant, $config->oauth->access_token_lifespan);
            $authCodeGrant->setRefreshTokenTTL($config->oauth->refresh_token_lifespan);

            // Enable the password grant on the server
            $server->enableGrantType($passwordGrant, $config->oauth->access_token_lifespan);

            return $server;
        });
    }
}
