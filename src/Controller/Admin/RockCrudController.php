<?php

namespace App\Controller\Admin;

use App\Entity\Rock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class RockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rock::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        if($pageName == 'index') {
            yield Field::new('name');
        /*yield BooleanField::new('online')
            ->renderAsSwitch(false);*/
        yield ChoiceField::new('online')
            ->setLabel('Status:')
            ->renderAsNativeWidget()
            ->setChoices([
                'online' => '1',
                'offline' => '0',
            ])
            ->setTemplatePath('admin/field/status.html.twig')
        ;
        yield Field::new('height');
        }
        

    }
    
}
