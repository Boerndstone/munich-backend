<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use App\Repository\RoutesRepository;
//use App\Form\RoutesAutocompleteField;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class FrontendController extends AbstractController
{
    /**
     * @Route("/frontend", name="frontend")
     */
    public function index(
        Request $request,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        Rock $rock = null,
        ManagerRegistry $doctrine,
    ): Response {

        $doctrineTutorial = $doctrine->getRepository(Area::class)->findAllOrderedBy();
        $search = $request->query->get('q');
        if ($search) {
            $areaSearch = $doctrine->getRepository(Area::class)->search($search);
        } else {
            $areaSearch = $doctrine->getRepository(Area::class)->findAllOrderedBy();
        }


        $searchTerm = $request->query->get('q');

        // Important for Stimulus!!!!!!
        /*$routesSearch = $routesRepository->search(
            $rock,
            $searchTerm
        );
        if($request->query->get('preview')) {
            return $this->render('pageParts/_searchPreview.html.twig', [
                'routesSearch' => $routesSearch,
            ]);
        }*/
        // End Important for Stimulus!!!!!!

        //dd($routesSearch);



        $area = $doctrine->getRepository(Area::class)->getTheStuff();
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        //dd($area);
        //$areaName = $area->getRocks()->getName();
        //dd($areaName);
        $routes = $doctrine->getRepository(Area::class)->getRocksRoutesFrontend();

        // Wie bekomme ich hier die Id der Area als Parameter in die funktion getGrades($area->getId())

        /*$sum = [];
        foreach($lowGrade as $low) {
            $getLowGrades = $doctrine->getRepository(Routes::class)->getGrades($area->getId(), 0, 15);
        }*/

        $getLowGrades = $doctrine->getRepository(Routes::class)->getGrades(1, 0, 15);
        //dd($getLowGrades);
        $getMiddleGrades = $doctrine->getRepository(Routes::class)->getGrades(1, 15, 29);
        $getHighGrades = $doctrine->getRepository(Routes::class)->getGrades(1, 29, 60);
        $getLowGradesArea = $doctrine->getRepository(Area::class)->getGradesArea(1, 0, 15);

        /*->getGradeMapForAread($areas);

        [
            'areaId' => [
                'low' => 5,
                'middle' => 
            ]
        ]*/

        $latestRoutes = $doctrine->getRepository(Routes::class)->latestRoutes();
        $banned = $doctrine->getRepository(Rock::class)->saisonalGesperrt();

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
            'area' => $area,
            //'areaName' => $areaName,
            'routes' => $routes,
            'latestRoutes' => $latestRoutes,
            'banned' => $banned,
            'getLowGrades' => $getLowGrades,
            'getMiddleGrades' => $getMiddleGrades,
            'getHighGrades' => $getHighGrades,
            'routes' => $routes,
            'searchTerm' => $searchTerm,
            'doctrineTutorial' => $doctrineTutorial,
            'search' => $search,
            'areaSearch' => $areaSearch
        ]);
    }

    /**
     * @Route("/Klettergebiet/{slug}", name="show_rocks")
     */
    public function showRocksArea(
        Request $request,
        ManagerRegistry $doctrine,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        Area $area,
        $slug,
        CacheInterface $cache
    ): Response {

        $search = $request->query->get('q');
        if ($search) {
            $areaSearch = $doctrine->getRepository(Area::class)->search($search);
        } else {
            $areaSearch = $doctrine->getRepository(Area::class)->findAllOrderedBy();
        }


        $searchTerm = $request->query->get('q');

        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        $areaName = $area->getName();
        $areaLat = $area->getLat();
        $areaLng = $area->getLng();
        $areaZoom = $area->getZoom();
        $rocks = $doctrine->getRepository(Rock::class)->findRocksArea($slug);
        $rock = $doctrine->getRepository(Rock::class)->findRocksArea($slug);

        $belowSix = array();

        $sum = [];
        foreach ($rock as $test) {
            $rs = $test->getRoutes();
            $id = $test->getId();

            if (!isset($sum[$id])) {
                $sum[$id] = [
                    '5' => 0,
                    '7-8' => 0,
                ];
            }

            foreach ($rs as $r) {
                $g = $r->getGrade();

                if (5 == $g or '5' == $g) {
                    $sum[$id]['5'] += 1;
                }

                if (7 == $g or '7' == $g or '7+' == $g) {
                    $sum[$id]['7-8'] += 1;
                }
            }

            // dd();
            // //$array = $test->getName();
            //  array_push($belowSix, $doctrine->getRepository(Routes::class)->findRoutesBelowSixForRock($test->getSlug()));
        }

        // dd($sum);

        $belowSix = array();
        foreach ($rock as $rockGrades) {
            array_push($belowSix, $doctrine->getRepository(Routes::class)->findRoutesBelowSixForRock($rockGrades->getSlug()));
        }

        $belowEight = array();
        foreach ($rock as $rockGrades) {
            array_push($belowEight, $doctrine->getRepository(Routes::class)->findRoutesBelowEightForRock($rockGrades->getSlug()));
        }

        $greaterEight = array();
        foreach ($rock as $rockGrades) {
            array_push($greaterEight, $doctrine->getRepository(Routes::class)->findRoutesGreaterEightForRock($rockGrades->getSlug()));
        }

        $projects = array();
        foreach ($rock as $rockGrades) {
            array_push($projects, $doctrine->getRepository(Routes::class)->findProjectForRock($rockGrades->getSlug()));
        }


        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'areaName' => $areaName,
            'areaLat' => $areaLat,
            'areaLng' => $areaLng,
            'areaZoom' => $areaZoom,
            'rocks' => $rocks,
            'belowSix' => $belowSix,
            'belowEight' => $belowEight,
            'greaterEight' => $greaterEight,
            'projects' => $projects,
            'sum' => $sum,
            'searchTerm' => $searchTerm,
        ]);
    }

    /**
     * @Route("/Kletterfels/{slug}", name="show_rock")
     */
    public function showRock(
        Request $request,
        ManagerRegistry $doctrine,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        //Area $area, 
        $slug,
        CacheInterface $cache

    ): Response {

        $search = $request->query->get('q');
        if ($search) {
            $areaSearch = $doctrine->getRepository(Area::class)->search($search);
        } else {
            $areaSearch = $doctrine->getRepository(Area::class)->findAllOrderedBy();
        }


        $searchTerm = $request->query->get('q');

        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        //$areaName = $doctrine->getRepository(Area::class)->getAreaName($slug);
        //dd($areaName);
        $rock = $doctrine->getRepository(Rock::class)->findRockName($slug);



        $belowSix = $doctrine->getRepository(Routes::class)->findRoutesBelowSixForRock($slug);
        $belowEight = $doctrine->getRepository(Routes::class)->findRoutesBelowEightForRock($slug);
        $greaterEight = $doctrine->getRepository(Routes::class)->findRoutesGreaterEightForRock($slug);
        $projects = $doctrine->getRepository(Routes::class)->findProjectForRock($slug);

        $routes = $doctrine->getRepository(Routes::class)->findRoutesRock($slug);


        return $this->render('frontend/rock.html.twig', [
            'areas' => $areas,
            'slug' => $slug,
            'rock' => $rock,
            'belowSix' => $belowSix,
            'belowEight' => $belowEight,
            'greaterEight' => $greaterEight,
            'projects' => $projects,
            'routes' => $routes,
            'searchTerm' => $searchTerm,

        ]);
    }

    /**
     * @Route("/neuesteRouten", name="neuesteRouten")
     */
    public function neuesteRouten(ManagerRegistry $doctrine): Response
    {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();

        $getDate = date("Y");
        $calculateDate = $getDate - 2;
        $latestRoutes = $doctrine->getRepository(Routes::class)->latestRoutesPage($calculateDate);

        return $this->render('frontend/neuesteRouten.html.twig', [
            'areas' => $areas,
            'latestRoutes' => $latestRoutes,
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
