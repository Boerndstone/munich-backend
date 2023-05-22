<?php

namespace App\Controller\Admin;

use App\Entity\ClimbedRoutes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClimbedRoutesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClimbedRoutes::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('area')
            ->setLabel('Gebiet')
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setHelp('Zu welchem Gebiet der Fels gehört.')
        ;
    }
    */
}
