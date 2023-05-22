<?php

namespace App\Controller\Admin;

use App\Entity\Area;
use App\Entity\Photos;
use App\Entity\Rock;
use App\Entity\Routes;
use App\Entity\ClimbedRoutes;
use App\Entity\Topo;
use App\Entity\User;
use App\Entity\Videos;
use App\Entity\ToDoListe;
use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use App\Repository\RoutesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    private RoutesRepository $routesRepository;

    private ChartBuilderInterface $chartBuilder;

    public function __construct(RoutesRepository $routesRepository, AreaRepository $areaRepository, RockRepository $rockRepository, ChartBuilderInterface $chartBuilder)
    {
        $this->areaRepository = $areaRepository;
        $this->rockRepository = $rockRepository;
        $this->routesRepository = $routesRepository;
        $this->chartBuilder = $chartBuilder;
    }

    // Have to to make user in db + user form!!!
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        $areas = $this->areaRepository->findAllAreasAlphabetical();
        $getRoutes = $this->routesRepository->getAllRoutes();
        $getAreas = $this->areaRepository->getAllAreas();
        $getRocks = $this->rockRepository->getAllRocks();

        return $this->render('admin/index.html.twig', [
            'chart' => $this->createChart(),
            'chartBernd' => $this->createChartBernd(),
            'areas' => $areas,
            'getAreas' => $getAreas,
            'getRocks' => $getRocks,
            'getRoutes' => $getRoutes,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Munichclimbs')
            ->setFaviconPath('build/images/favicon/favicon.png')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('To Do Liste', 'fa fa-tags', ToDoListe::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Gebiete', 'fa fa-tags', Area::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Felsen', 'fa fa-home', Rock::class);
        yield MenuItem::linkToCrud('Touren', 'fa fa-home', Routes::class);
        yield MenuItem::linkToCrud('Touren geklettert', 'fa fa-home', ClimbedRoutes::class);
        yield MenuItem::linkToCrud('Topos', 'fa fa-home', Topo::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Photos', 'fa fa-camera-retro', Photos::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Videos', 'fa fa-video', Videos::class);
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::section('Live Seite')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToUrl('munichclimbs', 'fa fa-link', 'https://munichclimbs.de')->setLinkTarget('_blank')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::section('Tools')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToUrl('Generiere UIAA Grade', 'fa fa-arrow-right-arrow-left', 'https://munichclimbs.de/calculateGradesUIAA.php')->setLinkTarget('_blank')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToUrl('Generiere FRENCH Grade', 'fa fa-arrow-right-arrow-left', 'https://munichclimbs.de/calculateGradesFRENCH.php')->setLinkTarget('_blank')->setPermission('ROLE_SUPER_ADMIN');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setAvatarUrl($user->getAvatarUrl());
    }

    // This is the setup for a global Show Action
    // It is possible to diable it for specific pages or disable it globally
    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureAssets(): Assets
    {
        $assets = parent::configureAssets();
        $assets->addWebpackEncoreEntry('admin');

        return $assets;
    }

    private function createChart(): Chart
    {
        $belowSix = $this->routesRepository->findAllRoutesBelowSix();
        $belowEight = $this->routesRepository->findAllRoutesBelowEight();
        $greaterEight = $this->routesRepository->findAllRoutesGreaterEight();
        $projects = $this->routesRepository->findAllProjectds();

        $chart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chart->setData([
            'labels' => ['1 - 5', '6 - 7', '8 - 11', 'Projekte'],
            'datasets' => [
                [
                    'label' => 'Schwierigkeiten',
                    'backgroundColor' => ['#15803d', '#075985', '#b91c1c', 'black'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$belowSix, $belowEight, $greaterEight, $projects],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                   'suggestedMin' => 0,
                   'suggestedMax' => 2500,
                ],
            ],
        ]);

        return $chart;
    }

    private function createChartBernd(): Chart
    {
        $alreadyClimbed = $this->routesRepository->findAllAlreadyClimbed();
        $allRoutes = $this->routesRepository->getAllRoutes();

        $chartBernd = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chartBernd->setData([
            'labels' => ['Routen gesamt', 'Bisher geklettert'],
            'datasets' => [
                [
                    'label' => 'Schwierigkeiten',
                    'backgroundColor' => ['#b91c1c', '#15803d'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$allRoutes, $alreadyClimbed],
                ],
            ],
        ]);
        $chartBernd->setOptions([
            'scales' => [
                'y' => [
                   'suggestedMin' => 0,
                   'suggestedMax' => 2500,
                ],
            ],
        ]);

        return $chartBernd;
    }
}
