<?php
namespace VegaCore\HttpKernel;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface KernelInterface
{
    
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
    public function boot(): void;


    /**
     * Charger le conteneur de dépendances.
     *
     * @return ContainerInterface
     */
    public function loadContainer(): ContainerInterface;


    /**
     * Soumettre la requête de la part contrôleur frontal pour traitement 
     * et lui retourne la réponse correspondante
     *
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response;


    /**
     * Retourner l'environnement de l'application.
     *
     * @return string
     */
    public function getEnvironment(): string;


    /**
     * Permettre de savoir si le mode béboggage est activé ou non.
     *
     * @return boolean
     */
    public function isDebug(): bool;


    /**
     * Retourner le contenu d'une ressource appartenant au noyau.
     *
     * @param string $resourceName
     * @return string
     */
    public function loadResource(string $resourceName): string;


    /**
     * Terminer la requête du client.
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function terminate(Request $request, Response $response): void;
}