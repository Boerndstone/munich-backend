<?php

namespace App\Controller\Admin;

use App\Entity\Rock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class RockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rock::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Felsen')
            ->setPageTitle(Crud::PAGE_EDIT, static function (Rock $rock) {
                return sprintf($rock->getName() );
            })
            ->setPageTitle(Crud::PAGE_DETAIL, static function (Rock $rock) {
                return sprintf($rock->getName() );
            })
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
            ->setLabel('ID')
        ;

        yield Field::new('name')
            ->setLabel('Name')
        ;

        yield AssociationField::new('area')
            ->setLabel('Gebiet')
        ;

        yield Field::new('slug')
            ->setLabel('URL')
            ->hideOnIndex()
        ;

        yield Field::new('nr')
            ->setLabel('Numer')
            ->hideOnIndex()
        ;

        yield TextareaField::new('description')
            ->setLabel('Beschreibung')
            ->hideOnIndex()
        ;

        yield TextareaField::new('nature')
            ->setLabel('Naturschutz')
            ->hideOnIndex()
        ;

        yield TextareaField::new('access')
            ->setLabel('Zustieg')
            ->hideOnIndex()
        ;

        yield NumberField::new('zone')
            ->setLabel('Zone')
            ->hideOnIndex()
        ;

        yield NumberField::new('banned')
            ->setLabel('Jahreszeitliche Sperrung')
            ->hideOnIndex()
        ;

        yield NumberField::new('height')
            ->setLabel('Height')
            ->setTemplatePath('admin/field/height.html.twig')
        ;

        yield ChoiceField::new('online')
            ->setLabel('Status')
            ->renderAsNativeWidget()
            ->setChoices([
                'online' => '1',
                'offline' => '0',
            ])
            ->setTemplatePath('admin/field/status.html.twig')
        ;

        yield Field::new('orientation')
            ->setLabel('Ausrichtung')
            ->hideOnIndex()
        ;

        yield Field::new('season')
            ->setLabel('Beste Jahreszeit')
            ->hideOnIndex()
        ;

        yield Field::new('child_friendly')
            ->setLabel('Kinderfreundlich')
            ->hideOnIndex()
        ;

        yield Field::new('sunny')
            ->setLabel('Sonnig')
            ->hideOnIndex()
        ;

        yield Field::new('rain')
            ->setLabel('Regensicher')
            ->hideOnIndex()
        ;

        yield Field::new('image')
            ->setLabel('Bilder')
            ->hideOnIndex()
        ;

        yield Field::new('header_image')
            ->setLabel('Header Bild')
            ->hideOnIndex()
        ;

        yield Field::new('topo')
            ->setLabel('Topo')
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

    }
    
}
