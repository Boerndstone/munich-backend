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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('id',
                TextType::class,
                    [
                        'attr' => [
                            'readonly' => true,
                        ],
                        'label_format' => 'ID',
                        'mapped' => false,
                        
                    ]
            )
            ->add('area', EntityType::class, [
                'class' => Area::class,
                'label_format' => 'Gebiet',
                'choice_label' => function(Area $area) {
                    return sprintf('(%d) %s', $area->getOnline(), $area->getName() );
                },
                'choices' => $this->areaRepository->findAllAreasAlphabetical(),
                
            ])
            ->add('name',
                TextType::class,
                    [
                        'label_format' => 'Name des Felsen',
                    ]
            )
            ->add('slug',
                TextType::class,
                    [
                        'label_format' => 'URL',
                    ]
            )
            ->add('nr',
                TextType::class,
                    [
                        'label_format' => 'Reihenfolge',
                    ]
            )
            ->add('description',
                TextareaType::class,
                    [
                        'attr' => [
                            'rows' => 5
                        ],
                        'label_format' => 'Beschreibung',
                    ]
            )
            ->add('access',
                TextareaType::class,
                    [
                        'attr' => [
                            'rows' => 5
                        ],
                        'label_format' => 'Zugang',
                    ]
            )
            ->add('nature',
                TextareaType::class,
                    [
                        'attr' => [
                            'rows' => 5
                        ],
                        'label_format' => 'Naturschutz',
                    ]
            )
            ->add('zone', 
                ChoiceType::class, [
                    'label_format' => 'Zone',
                    'choices'  => [
                        'Zone 1' => 1,
                        'Zone 2' => 2,
                        'Zone 3' => 3,
                    ],
                ]
            )
            ->add('banned', 
                ChoiceType::class, [
                    'label_format' => 'Befristete Sperrung',
                    'choices'  => [
                        'Nein' => 0,
                        'Ja' => 1,
                    ],
                ]
            )
            ->add('height',
                TextType::class,
                    [
                        'label_format' => 'Höhe',
                    ]
            )
            ->add('orientation',
                TextType::class,
                    [
                        'label_format' => 'Ausrichtung',
                    ]
            )
            ->add('season',
                TextType::class,
                    [
                        'label_format' => 'Beste Jahreszeit',
                    ]
            )
            ->add('child_friendly', 
                ChoiceType::class, [
                    'label_format' => 'Kinderfreundlich',
                    'choices'  => [
                        'perfekt' => 1,
                        'gut' => 2,
                        'kaum' => 3,
                    ],
                ]
            )
            ->add('sunny', 
                ChoiceType::class, [
                    'label_format' => 'Sonne',
                    'choices'  => [
                        'gar nicht' => 0,
                        'teils' => 1,
                        'mittel' => 2,
                        'sonnig' => 3,
                    ],
                ]
            )
            ->add('rain', 
                ChoiceType::class, [
                    'label_format' => 'Regengeschützt',
                    'choices'  => [
                        'gar nicht' => 0,
                        'teils' => 1,
                        'mittel' => 2,
                        'sonnig' => 3,
                    ],
                ]
            )
            ->add('image', 
            TextType::class,
                [
                    'label_format' => 'Foto',
                ]
            )
            ->add('header_image', 
            TextType::class,
                [
                    'label_format' => 'Header Foto',
                ]
            )
            ->add('topo', 
            TextType::class,
                [
                    'label_format' => 'Topo',
                ]
            )
            ->add('lat', 
            TextType::class,
                [
                    'label_format' => 'Längengrad',
                ]
            )
            ->add('lng', 
                TextType::class, [
                    'label_format' => 'Breitengrad',
                ]
            )
            ->add('online', 
                ChoiceType::class, [
                    'label_format' => 'Online',
                    'choices'  => [
                        'nein' => 0,
                        'ja' => 1,
                    ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rock::class
        ]);
    }
}
