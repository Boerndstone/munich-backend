<?php

namespace App\Controller\Admin;

use App\Entity\Topo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class TopoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Topo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideonForm()
        ;
        yield Field::new('name')
            ->setLabel('Name')
            ->setColumns('col-12 col-md-4')
        ;
        yield AssociationField::new('rocks')
            ->setLabel('Rock Id')
            ->setColumns('col-12 col-md-4')
        ;
        /*yield ImageField::new('image')
            ->setBasePath('uploads/topo')
            ->setUploadDir('public/uploads/topo')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->onlyOnForms()
        ;*/
        yield Field::new('image')
            ->setLabel('Bild')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-4')
        ;
        yield Field::new('withSector')
            ->setLabel('Mit Sektoren')
            ->setColumns('col-12')
            ->setTemplatePath('admin/field/votes.html.twig')
        ;
        yield TextareaField::new('svg')
            ->setLabel('Topo SVG')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;
        // Hier macht ein Association Field für die Topo Id bei der Route Sinn!
        // In Entiy anlegen.
        yield Field::new('number')
            ->setLabel('Nummer Sektor')
            ->setColumns('col-12')
            ->setHelp('Die Nummer die zur Topo Id bei der Route korrespondiert!')
        ;
    }
}
