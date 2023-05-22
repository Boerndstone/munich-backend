<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StimulusTrainingController extends AbstractController
{
    #[Route('/stimulus/training', name: 'app_stimulus_training')]
    public function index(): Response
    {
        return $this->render('stimulus_training/index.html.twig', [
            'controller_name' => 'StimulusTrainingController',
        ]);
    }
}
