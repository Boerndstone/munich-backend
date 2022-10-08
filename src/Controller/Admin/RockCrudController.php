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
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;



class RockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rock::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->setIcon('fa fa-plus')
                    ->setLabel('Fels hinzufügen')
                    ->setCssClass('btn btn-success')
                ;
            })

        ;
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

        yield Field::new('name')
            ->setLabel('Name')
            ->hideOnDetail() 
            ->setColumns('col-12 col-md-4')
        ;

        yield AssociationField::new('area')
            ->setLabel('Gebiet')
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield CollectionField::new('routes')
            ->setLabel(false)
            ->onlyOnDetail()
            ->setTemplatePath('admin/field/routes.html.twig')
            ->setFormType(AddressType::class)
            ->addCssClass('field-address')
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('slug')
            ->setLabel('URL')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('nr')
            ->setLabel('Reihenfolge')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setHelp('Reihenfolge auf der Live Seite in der Überischtstabelle')
            ->setColumns('col-12 col-md-4')
        ;

        yield TextareaField::new('description')
            ->setLabel('Beschreibung')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'snarkdown',
                ],
                'attr' => [
                    'data-snarkdown-target' => 'input',
                    'data-action' => 'snarkdown#render',
                ],
            ])
            ->setHelp('Vorschau:')
            ->setColumns('col-12')
        ;

        yield TextareaField::new('nature')
            ->setLabel('Naturschutz')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield TextareaField::new('access')
            ->setLabel('Zustieg')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield NumberField::new('zone')
            ->setLabel('Zone')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield NumberField::new('banned')
            ->setLabel('Jahreszeitliche Sperrung')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield NumberField::new('height')
            ->setLabel('Height')
            ->setTemplatePath('admin/field/height.html.twig')
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield ChoiceField::new('online')
            ->setLabel('Status')
            ->renderAsNativeWidget()
            ->setChoices([
                'online' => '1',
                'offline' => '0',
            ])
            ->setTemplatePath('admin/field/status.html.twig')
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('orientation')
            ->setLabel('Ausrichtung')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('season')
            ->setLabel('Beste Jahreszeit')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield ChoiceField::new('child_friendly')
            ->setLabel('Kinderfreundlich')
            ->renderAsNativeWidget()
            ->setChoices([
                'keine Angaben' => '',
                'gut geeignet' => '1',
                'teils geeignet' => '2',
                'ungeeignet' => '3',
            ])
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('sunny')
            ->setLabel('Sonnig')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('rain')
            ->setLabel('Regensicher')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('image')
            ->setLabel('Bilder')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('header_image')
            ->setLabel('Header Bild')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield Field::new('topo')
            ->setLabel('Topo')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield NumberField::new('lat')
            ->setLabel('Breitengrad')
            ->setNumDecimals(6)
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

        yield NumberField::new('lng')
            ->setLabel('Längengrad')
            ->setNumDecimals(6)
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12 col-md-4')
        ;

    }
    
}
