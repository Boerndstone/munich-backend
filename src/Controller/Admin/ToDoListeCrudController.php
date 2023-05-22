<?php

namespace App\Controller\Admin;

use App\Entity\ToDoListe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ToDoListeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ToDoListe::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
