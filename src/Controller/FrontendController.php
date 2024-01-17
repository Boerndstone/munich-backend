<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
use App\Entity\Topo;
use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use App\Repository\RoutesRepository;
use App\Repository\VideosRepository;
use App\Repository\TopoRepository;
//use App\Form\RoutesAutocompleteField;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\FooterAreas;


class FrontendController extends AbstractController
{
    /**
     * @Route("/frontend", name="frontend")
     */
    public function index(
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
        RoutesRepository $routesRepository,
        Request $request,
    ): Response {

        $searchTerm = $request->query->get('q');
        $latestRoutes = $routesRepository->latestRoutes();
        $banned = $rockRepository->saisonalGesperrt();
        $areas = $areaRepository->getAreasInformation();
        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
            'latestRoutes' => $latestRoutes,
            'banned' => $banned,
            'searchTerm' => $searchTerm,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Klettergebiet/{slug}", name="show_rocks")
     */
    public function showRocksArea(
        AreaRepository $areaRepository,
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

        $areas = $areaRepository->getAreasFrontend();
        $areaName = $area->getName();
        $areaLat = $area->getLat();
        $areaLng = $area->getLng();
        $areaZoom = $area->getZoom();

        $sideBar = $areaRepository->sidebarNavigation();
        $rocks = $rockRepository->getRocksInformation($slug);


        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'areaName' => $areaName,
            'areaLat' => $areaLat,
            'areaLng' => $areaLng,
            'areaZoom' => $areaZoom,
            'rocks' => $rocks,
            'searchTerm' => $searchTerm,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Kletterfels/{slug}", name="show_rock")
     */
    public function showRock(
        AreaRepository $areaRepository,
        Request $request,
        ManagerRegistry $doctrine,
        VideosRepository $videoRepository,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        TopoRepository $topoRepository,
        $slug,
        CacheInterface $cache,
        FooterAreas $footerAreas
    ): Response {

        $search = $request->query->get('q');
        if ($search) {
            $areaSearch = $doctrine->getRepository(Area::class)->search($search);
        } else {
            $areaSearch = $doctrine->getRepository(Area::class)->findAllOrderedBy();
        }

        $searchTerm = $request->query->get('q');

        $rockId = $rockRepository->getRockId($slug);

        $topos = $topoRepository->getTopos($rockId);

        $rocks = $rockRepository->getRockInformation($slug);
        $routes = $rockRepository->getRoutesTopo($slug);
        $sideBar = $areaRepository->sidebarNavigation();

        $areas = $footerAreas->getFooterAreas();

        return $this->render('frontend/rock.html.twig', [
            'areas' => $areas,
            'slug' => $slug,
            'rocks' => $rocks,
            'routes' => $routes,
            'searchTerm' => $searchTerm,
            'videoRepository' => $videoRepository,
            'routesRepository' => $routesRepository,
            'topos' => $topos,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/neuesteRouten", name="neuesteRouten")
     */
    public function neuesteRouten(
        AreaRepository $areaRepository,
        RoutesRepository $routesRepository,
        Request $request,
        ManagerRegistry $doctrine,
        FooterAreas $footerAreas,
    ): Response {

        $search = $request->query->get('q');
        if ($search) {
            $areaSearch = $doctrine->getRepository(Area::class)->search($search);
        } else {
            $areaSearch = $doctrine->getRepository(Area::class)->findAllOrderedBy();
        }

        $searchTerm = $request->query->get('q');

        $areas = $footerAreas->getFooterAreas();

        $getDate = date("Y");
        $calculateDate = $getDate - 2;
        $latestRoutes = $routesRepository->latestRoutesPage($calculateDate);

        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/neuesteRouten.html.twig', [
            'areas' => $areas,
            'searchTerm' => $searchTerm,
            'latestRoutes' => $latestRoutes,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Datenschutz", name="datenschutz")
     */
    public function datenschutz(
        AreaRepository $areaRepository,
        ManagerRegistry $doctrine
    ): Response {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/datenschutz.html.twig', [
            'areas' => $areas,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Impressum", name="impressum")
     */
    public function impressum(
        AreaRepository $areaRepository,
        ManagerRegistry $doctrine
    ): Response {
        $areas = $doctrine->getRepository(Area::class)->getAreasFrontend();
        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/impressum.html.twig', [
            'areas' => $areas,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Database", name="databasequeries")
     */
    public function databasequeries(
        ManagerRegistry $doctrine,
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
    ): Response {

        $dummyData = $rockRepository->getRocksInformation('Konstein');

        return $this->render('frontend/database-queries.html.twig', [
            'dummyData' => $dummyData,
        ]);
    }

    /**
     * @Route("/footer", name="footer")
     */
    public function footer(): Response
    {



        return $this->render('partials/_footer.html.twig', [
            'message' => $message
        ]);
    }
}
