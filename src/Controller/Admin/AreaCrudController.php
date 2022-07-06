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
            ->setPageTitle(Crud::PAGE_INDEX, 'Gebiete');
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield Field::new('name')
            //->hideOnIndex()
        ;

        yield Field::new('slug')
            ->setLabel('URL')
            ->hideOnIndex()
            ->setFormTypeOption(
                'disabled',
                $pageName !== Crud::PAGE_NEW
            )
        ;

        yield Field::new('orientation')
            ->setLabel('Ausrichtung')
            ->hideOnIndex()
        ;

        yield Field::new('sequence')
            ->setLabel('Reihenfolge')
        ;

        yield ChoiceField::new('online')
            ->setLabel('Status:')
            ->renderAsNativeWidget()
            ->setChoices([
                'Online' => '1',
                'Offline' => '0',
            ])
            ->setTemplatePath('admin/field/status.html.twig')
        ;

        yield Field::new('image')
            ->setLabel('Bild')
            ->hideOnIndex()
        ;

        yield Field::new('header_image')
            ->setLabel('Header Bild')
            ->hideOnIndex()
        ;

        yield Field::new('lat')
            ->setLabel('Breitengrad')
            ->hideOnIndex()
        ;

        yield Field::new('lng')
            ->setLabel('Längengrad')
            ->hideOnIndex()
        ;

        yield Field::new('zoom')
            ->setLabel('Zoomstufe')
            ->hideOnIndex()
        ;
        
    }
    
}
