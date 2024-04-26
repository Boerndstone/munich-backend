<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Routes;
use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use \Symfony\Bundle\SecurityBundle\Security;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class CommentCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->setIcon('fa fa-plus')
                    ->setLabel('Kommentar hinzufügen')
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
                    ->setLabel('Speichern und ein weiteres Gebiet hinzufügen');
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

        return parent::configureActions($actions)
            ->setPermission(Action::INDEX, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::DETAIL, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'Kommentare zu Routen')
            ->setPageTitle(Crud::PAGE_NEW, 'Kommentare zur Route hinzufügen')
            ->showEntityActionsInlined()
            ->setPageTitle(Crud::PAGE_EDIT, static function (Comment $comment) {
                return sprintf($comment->getComment());
            })
            ->setPageTitle(Crud::PAGE_DETAIL, static function (Comment $comment) {
                return sprintf($comment->getComment());
            })
            ->setFormOptions(['attr' => ['novalidate' => null]]);
    }


    public function configureFields(string $pageName): iterable
    {
        /** @var \Symfony\Component\Security\Core\User\UserInterface|null $user */
        $user = $this->security->getUser();

        // dd($user->getFirstname());

        yield TextField::new('user')
            ->setLabel('User')
            ->setFormattedValue('servus')
            ->setDisabled()
            ->setColumns('col-12')
            ->hideOnIndex();
        yield AssociationField::new('route')
            ->setLabel('Route')
            ->setColumns('col-12')
            ->hideOnIndex();
        yield TextEditorField::new('comment')
            ->setLabel('Kommentar zur Route')
            ->setColumns('col-12')
            ->hideOnIndex();
    }
}
