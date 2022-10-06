<?php

namespace App\Controller\Admin;

use App\Entity\Galerie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class GalerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Galerie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('id')
            ->hideonForm();
        yield AssociationField::new('belongsToArea')
            ->setLabel('Gebiet')
            ->setColumns('col-12 col-md-4');
        yield AssociationField::new('belongsToRock')
            ->setLabel('Fels')
            ->setColumns('col-12 col-md-4');
        yield AssociationField::new('belongsToRoute')
            ->setLabel('Tour')
            ->setColumns('col-12 col-md-4');
        yield Field::new('name')
            ->setLabel('Bild')
            ->hideOnIndex();
        /*yield ImageField::new('name')
            ->setUploadDir('public/uploads/galerie')
            ->setLabel('Bild')
            ->hideOnIndex();
        */
        yield Field::new('description')
            ->setLabel('Beschreibung')
            ->hideOnIndex();
        yield Field::new('photographer')
            ->setLabel('Fotograph');
    }
}
