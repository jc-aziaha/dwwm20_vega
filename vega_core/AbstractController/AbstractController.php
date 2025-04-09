<?php
namespace VegaCore\AbstractController;

use Twig\Environment;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected ContainerInterface $container;

    protected Environment $twig;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->twig = $this->container->get(Environment::class);
    }

    public function render(string $templateName, array $parameters = []): Response
    {
        $content = $this->twig->render($templateName, $parameters);

        return new Response($content);
    }
}