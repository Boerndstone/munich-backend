<?php

namespace App\Controller\Admin;

use App\Entity\Rock;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class RockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rock::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add(EntityFilter::new('area'))
        ;
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

            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action
                    ->setLabel('Änderungen speichern')
                    ->setCssClass('btn btn-success')
                ;
            })

            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action
                    ->setLabel('Speichern und bearbeiten fortsetzen')
                ;
            })

            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action
                    ->setLabel('Speichern')
                    ->setCssClass('btn btn-success')
                ;
            })

            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action
                    ->setLabel('Speichern und ein weiteres Gebiet hinzufügen')
                ;
            })

        ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Übersicht der Felsen')
            ->setPageTitle(Crud::PAGE_NEW, 'Neuen Fels anlegen')
            ->setPageTitle(Crud::PAGE_EDIT, static function (Rock $rock) {
                return sprintf($rock->getName());
            })
            ->setPageTitle(Crud::PAGE_DETAIL, static function (Rock $rock) {
                return sprintf($rock->getName());
            })
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('name')
            ->setLabel('Name Fels')
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield Field::new('slug')
            ->setLabel('URL des Fels')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setHelp('Die URL darf keine Leerzeichen oder Umlaute beinhalten!')
        ;

        yield AssociationField::new('area')
            ->setLabel('Gebiet')
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setHelp('Zu welchem Gebiet der Fels gehört.')
        ;

        yield CollectionField::new('routes')
            ->setLabel(false)
            ->onlyOnDetail()
            ->setTemplatePath('admin/field/routes.html.twig')
            ->setFormType(AddressType::class)
            ->addCssClass('field-address')
            ->setColumns('col-12 col-md-4')
        ;

        
        yield Field::new('nr')
            ->setLabel('Reihenfolge')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setHelp('Reihenfolge auf der Live Seite in der Überischtstabelle')
            ->setColumns('col-12')
        ;

        yield TextareaField::new('description')
            ->setLabel('Beschreibung')
            ->hideOnIndex()
            ->hideOnDetail()
            /*->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'snarkdown',
                ],
                'attr' => [
                    'data-snarkdown-target' => 'input',
                    'data-action' => 'snarkdown#render',
                ],
            ])*/
            ->setHelp('Beschreibung zum Fels.')
            ->setColumns('col-12')
        ;

        yield TextareaField::new('nature')
            ->setLabel('Naturschutz')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setHelp('Angaben die für den Naturschutz wichtig sind.')
        ;

        yield TextareaField::new('access')
            ->setLabel('Zustieg')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setHelp('Beschreibung des Zustiegs zum Fels.')
        ;

        yield ChoiceField::new('zone')
            ->setLabel('Zone')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setChoices([
                'Zone 1' => '1',
                'Zone 2' => '2',
                'Zone 3' => '3',
            ])
            ->setHelp('Befindet sich der Fels in einem zonierten Gebiet? Zone 1 - 3.')
        ;

        yield ChoiceField::new('banned')
            ->setLabel('Jahreszeitliche Sperrung')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
            ->setChoices([
                'Sperrungen bis 30.06.' => '1',
            ])
            ->setHelp('Gibt es eine jahreszeitliche Sperrung.')
        ;

        yield NumberField::new('height')
            ->setLabel('Höhe')
            ->setTemplatePath('admin/field/height.html.twig')
            ->hideOnDetail()
            ->setColumns('col-12')
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
            ->setColumns('col-12')
        ;

        yield Field::new('orientation')
            ->setLabel('Ausrichtung')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield ChoiceField::new('season')
            ->setLabel('Beste Jahreszeit')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setChoices([
                'Sommer' => 'Sommer',
                'Sommer Herbst' => 'Sommer Herbst',
                'Frühling Sommer Herbst' => 'Frühling Sommer Herbst',
            ])
            ->setColumns('col-12')
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
            ->setColumns('col-12')
            ->setHelp('Wie gut ist der Fels mit Kindern geeignet.')
        ;

        yield ChoiceField::new('sunny')
            ->setLabel('Sonnig')
            ->renderAsNativeWidget()
            ->setChoices([
                'keine Sonne' => '1',
                'teils Sonne' => '2',
                'sonnig' => '3',
            ])
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield ChoiceField::new('rain')
            ->setLabel('Regensicher')
            ->renderAsNativeWidget()
            ->setChoices([
                'regensicher' => '1',
                'kaum regensicher' => '2',
                'nicht regensicher' => '3',
            ])
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield Field::new('image')
            ->setLabel('Bilder')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield Field::new('header_image')
            ->setLabel('Header Bild')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield Field::new('topo')
            ->setLabel('Topo')
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield NumberField::new('lat')
            ->setLabel('Breitengrad')
            ->setNumDecimals(6)
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;

        yield NumberField::new('lng')
            ->setLabel('Längengrad')
            ->setNumDecimals(6)
            ->hideOnIndex()
            ->hideOnDetail()
            ->setColumns('col-12')
        ;
    }
}
