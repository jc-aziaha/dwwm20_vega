<?php
namespace VegaCore\HttpKernel;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use VegaCore\HttpKernel\KernelInterface;
use Symfony\Component\ErrorHandler\Debug;
use VegaCore\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Kernel implements KernelInterface
{

    /**
     * Environnement de l'application.
     *
     * @var string
     */
    protected string $environment;


    /**
     * Mode débogagge de l'application.
     *
     * @var boolean
     */
    protected bool $debug;


    /**
     * Le conteneur de services.
     *
     * @var ContainerInterface|null
     */
    protected ?ContainerInterface $container = null;


    public function __construct(string $environment, bool $debug)
    {
        $this->environment  = $environment;
        $this->debug        = $debug;
    }


    /**
     * Initialiser le noyau.
     *
     * @todo Ses rôles:
     *      - Désactiver les messages d'erreurs
     *      - Activer le déboggeur
     *      - Charger le conteneur de dépendances
     * 
     * @return void
     */
    public function boot(): void
    {
        // Désactiver les messages d'erreurs
        if ( $this->environment == "prod" && $this->debug == false ) 
        {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }

        // Activer le déboggeur
        if ( $this->debug ) 
        {
            Debug::enable();
        }

        // Charger le conteneur de dépendances
        $this->container = $this->loadContainer();

    }


    /**
     * Charger le conteneur de dépendances.
     *
     * @return ContainerInterface
     */
    public function loadContainer(): ContainerInterface
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($this->getProjectDir() . "/config/services.php");
        return $container = $builder->build();
    }

    public function getProjectDir(): string
    {
        return dirname(__DIR__, 2);
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
        $this->boot();

        $this->container->get(HttpKernelInterface::class)->handle($request);
    }


    /**
     * Retourner l'environnement de l'application.
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }



    /**
     * Permettre de savoir si le mode béboggage est activé ou non.
     *
     * @return boolean
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }


    /**
     * Retourner le contenu d'une ressource appartenant au noyau.
     *
     * @param string $resourceName
     * @return string
     */
    public function loadResource(string $resourceName): string
    {

    }


    /**
     * Terminer la requête du client.
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function terminate(Request $request, Response $response): void
    {
        
    }
}