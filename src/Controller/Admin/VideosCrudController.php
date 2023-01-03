<?php

namespace App\Controller\Admin;

use App\Entity\Videos;
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

class VideosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Videos::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->setIcon('fa fa-plus')
                    ->setLabel('Video hinzufügen')
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

    
    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideOnIndex()
            ->hideonForm();
        yield AssociationField::new('videoArea')
            ->setLabel('Gebiet');
        yield AssociationField::new('videoRocks')
            ->setLabel('Fels');
        yield AssociationField::new('videoRoutes')
            ->setLabel('Tour');
        yield Field::new('videoLink')
            ->setLabel('Link');
    }
    
}
