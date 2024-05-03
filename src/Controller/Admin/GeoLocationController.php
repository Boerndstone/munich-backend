<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class GeoLocationController extends AbstractDashboardController
{
    #[Route('/admin/geolocation', name: 'admin_geolocation')]
    public function index(): Response
    {
        return $this->render('admin/geolocation.html.twig');
    }
}
