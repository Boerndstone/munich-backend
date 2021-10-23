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
                        'row_attr' => ['class' => 'my-4 col-span-12'],
                        'attr' => [
                            'class' => 'mt-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                            'readonly' => true,
                        ],
                        'label_format' => 'ID',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        'mapped' => false,
                        
                    ]
            )
            ->add('area', EntityType::class, [
                'class' => Area::class,
                'row_attr' => ['class' => 'my-4 col-span-12'],
                'attr' => [
                    'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring ',
                    'style' => 'height: 39px;'
                ],
                'label_format' => 'Gebiet',
                'label_attr' => [
                    'class' => 'text-gray-700 font-medium'
                ],
                'choice_label' => function(Area $area) {
                    return sprintf('(%d) %s', $area->getOnline(), $area->getName() );
                },
                'choices' => $this->areaRepository->findAllAreasAlphabetical(),
                
            ])
            ->add('name',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Name des Felsen',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('slug',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'URL',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('nr',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Reihenfolge',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
            ->add('description',
                TextareaType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-12'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                            'rows' => 10
                        ],
                        'label_format' => 'Beschreibung',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('access',
                TextareaType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-12'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                            'rows' => 5
                        ],
                        'label_format' => 'Zugang',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('nature',
                TextareaType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-12'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                            'rows' => 5
                        ],
                        'label_format' => 'Naturschutz',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('zone', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-4'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 39px;'
                    ],
                    'label_format' => 'Zone',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'Zone 1' => 1,
                        'Zone 2' => 2,
                        'Zone 3' => 3,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
            ->add('banned', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-4'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 39px;'
                    ],
                    'label_format' => 'Befristete Sperrung',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'Nein' => 0,
                        'Ja' => 1,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
            ->add('height',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                        ],
                        'label_format' => 'Höhe',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('orientation',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-3'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                        ],
                        'label_format' => 'Ausrichtung',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('season',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-3'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                        ],
                        'label_format' => 'Beste Jahreszeit',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('child_friendly', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-3'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 39px;'
                    ],
                    'label_format' => 'Kinderfreundlich',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'perfekt' => 1,
                        'gut' => 2,
                        'kaum' => 3,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
            ->add('sunny', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-3'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 39px;'
                    ],
                    'label_format' => 'Sonne',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'gar nicht' => 0,
                        'teils' => 1,
                        'mittel' => 2,
                        'sonnig' => 3,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
            ->add('rain', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-3'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 39px;'
                    ],
                    'label_format' => 'Regengeschützt',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'gar nicht' => 0,
                        'teils' => 1,
                        'mittel' => 2,
                        'sonnig' => 3,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
            ->add('image', 
            TextType::class,
                [
                    'row_attr' => ['class' => 'my-4 col-span-3'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                    ],
                    'label_format' => 'Foto',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    
                ]
            )
            ->add('header_image', 
            TextType::class,
                [
                    'row_attr' => ['class' => 'my-4 col-span-3'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                    ],
                    'label_format' => 'Header Foto',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    
                ]
            )
            ->add('topo', 
            TextType::class,
                [
                    'row_attr' => ['class' => 'my-4 col-span-3'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                    ],
                    'label_format' => 'Topo',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    
                ]
            )
            ->add('lat', 
            TextType::class,
                [
                    'row_attr' => ['class' => 'my-4 col-span-4'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                    ],
                    'label_format' => 'Längengrad',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    
                ]
            )
            ->add('lng', 
                TextType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-4'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring tinymce',
                    ],
                    'label_format' => 'Breitengrad',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    
                ]
            )
            ->add('online', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4 col-span-4'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 39px;'
                    ],
                    'label_format' => 'Online',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'nein' => 0,
                        'ja' => 1,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rock::class,
        ]);
    }
}
