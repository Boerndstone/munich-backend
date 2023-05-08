<?php

namespace App\Form;

use App\Entity\Area;
use App\Repository\AreaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class AreaAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Area::class,
            'placeholder' => 'Choose a Area',
            //'choice_label' => 'name',

            'query_builder' => function(AreaRepository $areaRepository) {
                return $areaRepository->createQueryBuilder('area');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
