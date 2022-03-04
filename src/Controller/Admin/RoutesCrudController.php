<?php

namespace App\Controller\Admin;

use App\Entity\Routes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class RoutesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Routes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideonForm();
        yield Field::new('name');
        yield AssociationField::new('area')
            ->autocomplete();
        yield AssociationField::new('rock');
        yield Field::new('grade')
            ->setLabel('Schwierigkeitsgrad');
        yield Field::new('climbed')
            ->setLabel('Bereits geklettert');
        yield Field::new('first_ascent')
            ->setLabel('Erstbegeher')
            ->hideOnIndex();
        yield Field::new('year_first_ascent')
            ->hideOnIndex();
    }
    
}
