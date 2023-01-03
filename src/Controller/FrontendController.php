<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Rock;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class FrontendController extends AbstractController
{
    /**
     * @Route("/frontend", name="frontend")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
        ]);
    }

    /**
     * @Route("/frontend/create-topo", name="create_topo")
     */
    public function create(): Response
    {
        return $this->render('frontend/create.topo.html.twig', []);
    }

    /**
     * @Route("/Klettergebiet/{slug}", name="show_rocks")
     */
    public function showRocksArea(ManagerRegistry $doctrine, $slug, CacheInterface $cache): Response
    {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        $rocks = $doctrine->getRepository(Rock::class)->findRocksArea($slug);

        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'rocks' => $rocks,
        ]);
    }

    /**
     * @Route("/Kletterfels/{slug}", name="show_rock")
     */
    public function showRock(ManagerRegistry $doctrine, $slug, CacheInterface $cache): Response
    {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        $rock = $doctrine->getRepository(Rock::class)->findRockName($slug);

        return $this->render('frontend/rock.html.twig', [
            'areas' => $areas,
            'rock' => $rock,
        ]);
    }
}
