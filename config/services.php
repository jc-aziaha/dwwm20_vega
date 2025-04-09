<?php

use Psr\Container\ContainerInterface;
use VegaCore\HttpKernel\HttpKernel;
use VegaCore\HttpKernel\HttpKernelInterface;

return [
    HttpKernelInterface::class => DI\create(HttpKernel::class)->constructor(DI\get(ContainerInterface::class))


];