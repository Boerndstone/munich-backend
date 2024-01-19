<?php

namespace App\Controller;

use App\Repository\AreaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorController extends AbstractController
{
    public function showError(\Throwable $exception, AreaRepository $areaRepository,): Response
    {
        $sideBar = $areaRepository->sidebarNavigation();
        $areas = $areaRepository->getAreasInformation();

        if ($exception instanceof NotFoundHttpException) {
            return $this->render('error404.html.twig', [
                'areas' => $areas,
                'sideBar' => $sideBar,
            ], new Response('', 404));
        }

        // Handle other exceptions or return a generic error page
        return $this->render('error.html.twig', [
            'areas' => $areas,
            'sideBar' => $sideBar,

        ], new Response('', 500));
    }
}
