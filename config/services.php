<?php

use App\Controller\WelcomeController;
use Psr\Container\ContainerInterface;
use VegaCore\HttpKernel\HttpKernel;
use VegaCore\HttpKernel\HttpKernelInterface;
use VegaCore\Routing\Router;
use VegaCore\Routing\RouterInterface;

return [
    HttpKernelInterface::class => DI\create(HttpKernel::class)
                                    ->constructor(DI\get(ContainerInterface::class)),

    RouterInterface::class => DI\create(Router::class)->constructor(DI\get('controllers')),

    'controllers' => [
        WelcomeController::class
    ]
];