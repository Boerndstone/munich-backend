<?php

namespace App\Controller;

use App\Entity\Area;

use App\Repository\AreaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="frontend")
     */
    public function index(): Response
    {

        //$areas = $areaRepository->findAll();

        $areas = $this->getDoctrine()->getRepository(Area::class)->findAllAreasFrontend();

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
        ]);
    }
}
