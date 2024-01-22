<?php

namespace App\Controller\Admin;

use App\Entity\Photos;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class PhotosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photos::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->setIcon('fa fa-plus')
                    ->setLabel('Foto hinzufügen')
                    ->setCssClass('btn btn-success');
            })

            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action
                    ->setLabel('Änderungen speichern')
                    ->setCssClass('btn btn-success');
            })

            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action
                    ->setLabel('Speichern und bearbeiten fortsetzen');
            })

            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action
                    ->setLabel('Speichern')
                    ->setCssClass('btn btn-success');
            })

            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action
                    ->setLabel('Speichern und ein weiteres Foto hinzufügen');
            })

            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action
                    ->setLabel('Bearbeiten')
                    ->setCssClass('btn btn-success');
            })

            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action
                    ->setLabel('Zurück zur Liste');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action
                    ->setLabel('Löschen');
            });
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Übersicht der Fotos')
            ->setPageTitle(Crud::PAGE_NEW, 'Foto hinzufügen')
            ->showEntityActionsInlined()
            ->setPageTitle(Crud::PAGE_EDIT, static function (Photos $photos) {
                return sprintf($photos->getBelongsToRoute());
            })
            ->setPageTitle(Crud::PAGE_DETAIL, static function (Photos $photos) {
                return sprintf($photos->getBelongsToRoute());
            })
            ->setFormOptions(['attr' => ['novalidate' => null]]);
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideOnIndex()
            ->hideonForm();
        yield AssociationField::new('belongsToArea')
            ->setLabel('Gebiet')
            ->setColumns('col-12');
        yield AssociationField::new('belongsToRock')
            ->setLabel('Fels')
            ->setColumns('col-12');
        yield AssociationField::new('belongsToRoute')
            ->setLabel('Tour')
            ->setColumns('col-12');
        /*yield Field::new('name')
            ->setLabel('Bild')
            ->hideOnIndex()
            ->setColumns('col-12');
        */
        yield ImageField::new('name')
            ->setUploadDir('public/uploads/galerie')
            ->setLabel('Bild')
            ->hideOnIndex()
            ->setColumns('col-12');

        yield Field::new('description')
            ->setLabel('Beschreibung')
            ->hideOnIndex()
            ->setColumns('col-12');
        yield Field::new('photgrapher')
            ->setLabel('Fotograph')
            ->setColumns('col-12');
    }
}
