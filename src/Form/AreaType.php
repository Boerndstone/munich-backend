<?php

namespace App\Form;

use App\Entity\Area;
use App\Entity\Rock;
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

use Symfony\Component\Form\FormErrorIterator;


class AreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Name des Gebietes',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        'help' => 'Name des Gebiets',
                        'help_attr' => [
                            'class' => 'text-xs text-gray-700 mt-2 ml-2'
                        ],
                        'invalid_message' => 'Symfony is too smart for your hacking!'
                        
                    ]
            )
            ->add('slug',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'URL',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        'help' => 'URL des Gebiets soll keine Umlaute haben',
                        'help_attr' => [
                            'class' => 'text-xs text-gray-700 mt-2 ml-2'
                        ]
                        
                    ]
            )
            ->add('orientation',
                ChoiceType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                            'style' => 'height: 42px;'
                        ],
                        'label_format' => 'Wo im Umkreis von München',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        'choices'  => [
                            'Norden' => 'north',
                            'Ost' => 'east',
                            'Süden' => 'south',
                            'Westen' => 'west',
                        ],
                        
                    ]
            )
            ->add('sequence',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Reihenfolge',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
            ->add('online', 
                ChoiceType::class, [
                    'row_attr' => ['class' => 'my-4'],
                    'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        'style' => 'height: 42px;'
                    ],
                    'label_format' => 'Online',
                    'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ],
                    'choices'  => [
                        'Ja' => 1,
                        'Nein' => 0,
                    ],
                    'invalid_message' => 'Symfony is too smart for your hacking!'
                ]
            )
            ->add('image',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Bild',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
            ->add('header_image',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Header Bild',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
            ->add('lat',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Breitengrad',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
            ->add('lng',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Längengrad',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
            ->add('zoom',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Zoom',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ]
                        
                    ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Area::class,
        ]);
    }
}
