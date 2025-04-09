<?php
namespace VegaCore\HttpKernel;

use Psr\Container\ContainerInterface;
use VegaCore\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpKernel implements HttpKernelInterface
{

    /**
     * Le conteneur de services.
     * @var ContainerInterface
     */
    private ContainerInterface $container;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Soumettre la requête de la part contrôleur frontal pour traitement 
     * et lui retourne la réponse correspondante
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        dd($this->container, "Continuer la partie");
    }
}