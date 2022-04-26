<?php

namespace App\Controller\Admin;

use App\Entity\Routes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

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
        yield Field::new('name')
            ->setLabel('Tourenname');
        yield AssociationField::new('area')
            ->setLabel('Gebiet');
        yield AssociationField::new('rock')
            ->setLabel('Fels');
        yield Field::new('grade')
            ->setLabel('Schwierigkeitsgrad');
        yield Field::new('climbed')
            ->setLabel('Bereits geklettert');
        yield Field::new('first_ascent')
            ->setLabel('Erstbegeher')
            ->hideOnIndex();
        yield Field::new('year_first_ascent')
            ->setLabel('Jahr der Erstbegehung')
            ->hideOnIndex();
        yield ChoiceField::new('protection')
            ->setLabel('Absicherung')
            ->hideOnIndex()
            ->setHelp('Wie die Absicherung ist, von gut bis sehr gefährlich!')
            ->setChoices([
                'gut abgesichert' => '1',
                'vorsichtig' => '2',
                'gefährlich' => '3',
            ]);

    }
    
}
