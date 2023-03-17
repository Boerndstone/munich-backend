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
        $routes = $doctrine->getRepository(Area::class)->getRocksRoutesFrontend();
        //$rock = $doctrine->getRepository(Rock::class)->find($id);
        //$test = $area->getId();

        //dd($test);

        //$getRoutes = [];
        /*foreach($areas as $value) {
            //dd($value->getId());
            array_push($getRoutes, $value->getId());
        }Ü*/

        //$area = $doctrine->getRepository(Area::class)->findBy($areas[0]->getId());

        //$area = $areas[0]->getId();

        //dd($getRoutes);
        //$getRoute = $doctrine->getRepository(Area::class)->getRocksLowerFiveteen($getRoutes);
        //$getRoute = $doctrine->getRepository(Area::class)->getRocksLowerFiveteen();

        //dd($getRoutes);

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
            'routes' => $routes,
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
        $headline = $slug;


        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'rocks' => $rocks,
            'headline' => $headline,
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

    /**
     * @Route("/Datenschutz", name="datenschutz")
     */
    public function datenschutz(ManagerRegistry $doctrine): Response
    {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();

        return $this->render('frontend/datenschutz.html.twig', [
            'areas' => $areas,
        ]);
    }

    /**
     * @Route("/Impressum", name="impressum")
     */
    public function impressum(ManagerRegistry $doctrine): Response
    {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();

        return $this->render('frontend/impressum.html.twig', [
            'areas' => $areas,
        ]);
    }
}
