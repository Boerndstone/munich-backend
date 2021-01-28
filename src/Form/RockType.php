<?php

namespace App\Form;

use App\Entity\Rock;
use App\Entity\Area;
use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RockType extends AbstractType
{

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            //->add('areaRelation')
            ->add('areaRelation', EntityType::class, [
                'class' => Area::class,
                'attr' => [
                    'class' => 'block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
                    'placeholder' => 'Wähle ein Gebiet'
                ],
                'choice_label' => function(Area $area) {
                    return sprintf('(%d) %s', $area->getOnline(), $area->getName() );
                },
                'choices' => $this->areaRepository->findAllAreasAlphabetical(),
                
            ])
            ->add('name',
                TextType::class,
                    [
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        
                    ]
            )
            ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rock::class,
        ]);
    }
}
