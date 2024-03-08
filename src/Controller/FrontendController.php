<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Rock;
use App\Repository\AreaRepository;
use App\Repository\PhotosRepository;
use App\Repository\RockRepository;
use App\Repository\RoutesRepository;
use App\Repository\VideosRepository;
use App\Repository\TopoRepository;
//use App\Form\RoutesAutocompleteField;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Asset\Packages;

use App\Service\FooterAreas;


class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
        RoutesRepository $routesRepository,
        Request $request
    ): Response {

        $latestRoutes = $routesRepository->latestRoutes();
        $banned = $rockRepository->saisonalGesperrt();
        $areas = $areaRepository->getAreasInformation();
        $sideBar = $areaRepository->sidebarNavigation();
        $searchTerm = $request->query->get('q');
        $searchRoutes = $areaRepository->search($searchTerm);
        //dd($searchRoutes);

        return $this->render('frontend/index.html.twig', [
            'areas' => $areas,
            'latestRoutes' => $latestRoutes,
            'banned' => $banned,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Klettergebiet/{slug}", name="show_rocks")
     */
    public function showRocksArea(
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
        Area $area,
        $slug,
        FooterAreas $footerAreas
    ): Response {

        $areas = $footerAreas->getFooterAreas();
        $areaName = $area->getName();
        $areaSlug = $area->getSlug();
        $areaLat = $area->getLat();
        $areaLng = $area->getLng();
        $areaZoom = $area->getZoom();

        $sideBar = $areaRepository->sidebarNavigation();
        $rocks = $rockRepository->getRocksInformation($slug);


        return $this->render('frontend/rocks.html.twig', [
            'areas' => $areas,
            'areaName' => $areaName,
            'areaSlug' => $areaSlug,
            'areaLat' => $areaLat,
            'areaLng' => $areaLng,
            'areaZoom' => $areaZoom,
            'rocks' => $rocks,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Kletterfels/{slug}", name="show_rock")
     */
    public function showRock(
        AreaRepository $areaRepository,
        VideosRepository $videoRepository,
        RoutesRepository $routesRepository,
        RockRepository $rockRepository,
        TopoRepository $topoRepository,
        PhotosRepository $photosRepository,
        Rock $rock,
        $slug,
        FooterAreas $footerAreas,
        Packages $assetPackages
    ): Response {


        $rockId = $rockRepository->getRockId($slug);

        $topos = $topoRepository->getTopos($rockId);

        $rockName = $rock->getSlug();
        $areaName = $rock->getArea();

        $rockDescription = $rock->getDescription();

        $rocks = $rockRepository->getRockInformation($slug);
        $routes = $rockRepository->getRoutesTopo($slug);

        $galleryItems = $photosRepository->findPhotosForRock($rockId);

        // Serialize data to JSON format
        $jsonData = [];
        foreach ($galleryItems as $item) {
            $jsonData[] = [
                'src' =>
                $assetPackages->getUrl('https://www.munichclimbs.de/build/images/galerie/' . $item->getName() . '.webp'),
                'subHtml' => $item->getDescription(),
            ];
        }

        $sideBar = $areaRepository->sidebarNavigation();

        $areas = $footerAreas->getFooterAreas();

        return $this->render('frontend/rock.html.twig', [
            'areaName' => $areaName,
            'areas' => $areas,
            'slug' => $slug,
            'rocks' => $rocks,
            'rockName' => $rockName,
            'rockDescription,' => $rockDescription,
            'routes' => $routes,
            'videoRepository' => $videoRepository,
            'routesRepository' => $routesRepository,
            'topos' => $topos,
            'sideBar' => $sideBar,
            'jsonData' => $jsonData
        ]);
    }

    /**
     * @Route("/neuesteRouten", name="neuesteRouten")
     */
    public function neuesteRouten(
        AreaRepository $areaRepository,
        RoutesRepository $routesRepository,
        FooterAreas $footerAreas,
    ): Response {

        $areas = $footerAreas->getFooterAreas();

        $getDate = date("Y");
        $calculateDate = $getDate - 2;
        $latestRoutes = $routesRepository->latestRoutesPage($calculateDate);

        $sideBar = $areaRepository->sidebarNavigation();

        return $this->render('frontend/neuesteRouten.html.twig', [
            'areas' => $areas,
            'latestRoutes' => $latestRoutes,
            'sideBar' => $sideBar,
        ]);
    }

    /**
     * @Route("/Datenschutz", name="datenschutz")
     */
    public function datenschutz(
        AreaRepository $areaRepository,
        FooterAreas $footerAreas,
    ): Response {
        $areas = $footerAreas->getFooterAreas();
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
        FooterAreas $footerAreas,
    ): Response {
        $areas = $footerAreas->getFooterAreas();
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
        AreaRepository $areaRepository,
        RockRepository $rockRepository,
    ): Response {

        $dummyData = $areaRepository->sidebarNavigation();

        return $this->render('frontend/database-queries.html.twig', [
            'dummyData' => $dummyData,
        ]);
    }
}
