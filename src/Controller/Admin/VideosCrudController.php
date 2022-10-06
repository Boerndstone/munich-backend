<?php

namespace App\Controller\Admin;

use App\Entity\Videos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class VideosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Videos::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideOnIndex();
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
