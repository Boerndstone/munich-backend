<?php

namespace App\Controller\Admin;

use App\Entity\Area;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class AreaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Area::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Gebiete')
            ->setPageTitle(Crud::PAGE_EDIT, static function (Area $area) {
                return sprintf($area->getName() );
            })
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield Field::new('name')
            //->hideOnIndex()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('slug')
            ->setLabel('URL')
            ->hideOnIndex()
            ->setFormTypeOption(
                'disabled',
                $pageName !== Crud::PAGE_NEW
            )
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('orientation')
            ->setLabel('Ausrichtung')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('sequence')
            ->setLabel('Reihenfolge')
            ->setColumns('col-12 col-md-4')
        ;

        yield ChoiceField::new('online')
            ->setLabel('Status:')
            ->renderAsNativeWidget()
            ->setChoices([
                'Online' => '1',
                'Offline' => '0',
            ])
            ->setTemplatePath('admin/field/status.html.twig')
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('image')
            ->setLabel('Bild')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('header_image')
            ->setLabel('Header Bild')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-3')
        ;

        yield Field::new('lat')
            ->setLabel('Breitengrad')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-3')
        ;

        yield Field::new('lng')
            ->setLabel('Längengrad')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-3')
        ;

        yield Field::new('zoom')
            ->setLabel('Zoomstufe')
            ->hideOnIndex()
            ->setColumns('col-12 col-md-3')
        ;
        
    }
    
}
