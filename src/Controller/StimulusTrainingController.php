<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RoutesRepository;
use App\Repository\RockRepository;
use App\Entity\Routes;
use App\Entity\Rock;

class StimulusTrainingController extends AbstractController
{
    #[Route('/stimulus/training', name: 'app_stimulus_training')]
    public function index(
        Request $request,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        Rock $rock = null
    ): Response {

        $searchTerm = $request->query->get('q');
        $routes = $routesRepository->search(
            $rock,
            $searchTerm
        );

        if ($request->query->get('preview')) {
            return $this->render('pageParts/_searchPreview.html.twig', [
                'routes' => $routes,
            ]);
        }

        //dd($searchTerm);

        return $this->render('stimulus_training/index.html.twig', [
            'searchTerm' => $searchTerm,
            'routes' => $routes,
            'rock' => $rockRepository->findAll(),
        ]);
    }

    #[Route('/stimulus/autocomplete', name: 'app_stimulus_autocomplete')]
    public function autocomplete(Request $request)
    {
        $query = $request->query->get('q'); // Get the search query from the request

        // Perform a search in the entity repository based on the query
        $results = $this->getDoctrine()->getRepository(Routes::class)->search($query);

        // Serialize the search results into JSON and return the response
        return new JsonResponse($results);
    }
}
