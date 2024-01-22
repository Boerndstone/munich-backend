<?php

namespace App\Controller\Admin;

use App\Entity\ToDoListe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ToDoListeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ToDoListe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setPageTitle(Crud::PAGE_INDEX, 'To Dos')
            ->setPageTitle(Crud::PAGE_NEW, 'Neues To Do')
            ->showEntityActionsInlined();
    }
}
