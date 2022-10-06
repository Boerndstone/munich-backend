<?php

namespace App\Controller\Admin;
use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
use App\Entity\User;
use App\Entity\Videos;
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
#use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
#use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{

    private RoutesRepository $routesRepository;
    #public function __construct(RoutesRepository $routesRepository, ChartBuilderInterface $chartBuilder)
    public function __construct(RoutesRepository $routesRepository)
    {
        $this->routesRepository = $routesRepository;
        #$this->chartBuilder = $chartBuilder;
    }

    // Have to to make user in db + user form!!!
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

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
        return $this->render('admin/index.html.twig', [
            //'chart' => $this->createChart(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Munichclimbs')
            //->setFaviconPath("{{ asset('favicon.png') }}")
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Gebiete', 'fa fa-tags', Area::class);
        yield MenuItem::linkToCrud('Felsen', 'fa fa-home', Rock::class);
        yield MenuItem::linkToCrud('Touren', 'fa fa-home', Routes::class);
        yield MenuItem::linkToCrud('Videos', 'fa fa-video', Videos::class);
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        yield MenuItem::section('Live Seite');
        yield MenuItem::linkToUrl('munichclimbs', 'fa fa-link', 'https://munichclimbs.de')->setLinkTarget('_blank');
        yield MenuItem::section('Tools');
        yield MenuItem::linkToUrl('Generiere UIAA Grade', 'fa fa-arrow-right-arrow-left', 'https://munichclimbs.de/calculateGradesUIAA.php')->setLinkTarget('_blank');
        yield MenuItem::linkToUrl('Generiere FRENCH Grade', 'fa fa-arrow-right-arrow-left', 'https://munichclimbs.de/calculateGradesFRENCH.php')->setLinkTarget('_blank');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
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
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }
    /*private function createChart(): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                   'suggestedMin' => 0,
                   'suggestedMax' => 100,
                ],
            ],
        ]);
        return $chart;
    }*/
}
