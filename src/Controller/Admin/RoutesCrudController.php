<?php

namespace App\Controller\Admin;

use App\Entity\Routes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class RoutesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Routes::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->setIcon('fa fa-plus')
                    ->setLabel('Tour hinzufügen')
                    ->setCssClass('btn btn-success')
                ;
            });
            return parent::configureActions($actions)
                ->setPermission(Action::INDEX, 'ROLE_MODERATOR')
                ->setPermission(Action::DETAIL, 'ROLE_MODERATOR')
                ->setPermission(Action::EDIT, 'ROLE_MODERATOR')
                ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
                ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN')
            ;

        ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Routen')
            ->setPageTitle(Crud::PAGE_EDIT, static function (Routes $routes) {
                return sprintf($routes->getName() );
            })
            ->setPageTitle(Crud::PAGE_DETAIL, static function (Routes $routes) {
                return sprintf($routes->getName() );
            })
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideonForm();
        yield Field::new('name')
            ->setLabel('Tourenname')
            ->setColumns('col-12 col-md-4')
        ;
        yield AssociationField::new('area')
            ->setLabel('Gebiet')
            ->setColumns('col-12 col-md-4')
        ;
        yield AssociationField::new('rock')
            ->setLabel('Fels')
            ->setColumns('col-12 col-md-4')
        ;
        yield Field::new('grade')
            ->setLabel('Schwierigkeitsgrad')
            ->setColumns('col-12')
        ;
        yield Field::new('climbed')
            ->setLabel('Bereits geklettert')
            ->setColumns('col-12')
            ->setTemplatePath('admin/field/votes.html.twig')
        ;
        yield Field::new('first_ascent')
            ->setLabel('Erstbegeher')
            ->setColumns('col-12 col-md-4')
            ->hideOnIndex()
        ;
        yield Field::new('year_first_ascent')
            ->setLabel('Jahr der Erstbegehung')
            ->setColumns('col-12 col-md-4')
            ->hideOnIndex()
        ;
        yield ChoiceField::new('protection')
            ->setLabel('Absicherung')
            ->setColumns('col-12 col-md-4')
            ->hideOnIndex()
            ->setHelp('Wie die Absicherung ist, von gut bis sehr gefährlich!')
            ->setChoices(
                [
                    'gut abgesichert' => '1',
                    'vorsichtig' => '2',
                    'gefährlich' => '3',
                ]
            )
        ;
        yield Field::new('description')
            ->setLabel('Beschreibung')
            ->setColumns('col-12')
            ->hideOnIndex()
        ;
        yield Field::new('grade_no')
            ->setLabel('Grade')
            ->setColumns('col-12')
            ->hideOnIndex()
        ;
        yield ChoiceField::new('rating')
            ->setLabel('Schönheit')
            ->setColumns('col-12 col-md-4')
            ->hideOnIndex()
            ->setHelp('Schönheit der Route.')
            ->setChoices(
                [
                    'schlecht => Mülltonne' => '-1',
                    'gut => ein Stern' => '1',
                    'super  => zwei Sterne' => '2',
                    'fantastisch   => drei Sterne' => '3',
                ]
            )
        ;
        yield Field::new('topo_id')
            ->setLabel('Topo ID')
            ->setColumns('col-12 col-md-4')
            ->hideOnIndex()
        ;
        yield Field::new('nr')
            ->setLabel('Reihenfolge')
            ->setColumns('col-12 col-md-4')
            ->hideOnIndex()
        ;

    }
    
}
