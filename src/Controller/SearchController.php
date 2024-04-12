<?php
// src/Controller/SearchController.php
namespace App\Controller;

use App\Repository\RockRepository;
use App\Repository\RoutesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $request, RockRepository $rockRepository, RoutesRepository $routeRepository): Response
    {
        $query = $request->query->get('query');
        $rocks = $rockRepository->search($query);

        // Convert the search results to an array of arrays
        $rocksArray = array_map(function ($rock) {
            return [
                'id' => $rock->getId(),
                'name' => $rock->getName(),
                'url' => $this->generateUrl('show_rock', ['areaSlug' => $rock->getArea()->getSlug(), 'slug' => $rock->getSlug()]),

            ];
        }, $rocks);

        return $this->json($rocksArray);
    }
}
