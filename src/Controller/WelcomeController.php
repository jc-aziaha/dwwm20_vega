<?php
namespace App\Controller;

use AttributesRouter\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index(): Response
    {
        return new Response("Hello");
    }

    #[Route('/test', name: 'app_test', methods: ['GET'])]
    public function test(): Response
    {
        return new Response("test");
    }
}