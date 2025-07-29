<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return new Response('<h1>Munich Backend is working!</h1><p>API: <a href="/api">/api</a></p><p>Admin: <a href="/admin">/admin</a></p>');
    }
}
