<?php

namespace App\Controller\Admin;

use App\Entity\Routes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class RoutesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Routes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield Field::new('name');
        yield Field::new('grade');
        yield Field::new('climbed');
        yield Field::new('first_ascent');
        yield Field::new('year_first_ascent');
    }
    
}
