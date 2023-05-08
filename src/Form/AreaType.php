<?php

namespace App\Form;

use App\Entity\Area;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                TextType::class,
                [
                    // 'row_attr' => ['class' => 'col-span-1 md:col-span-2'],
                    /*'attr' => [
                        'class' => 'mt-2 bg-white text-black rounded py-2 px-4 block w-full',
                    ],*/
                    'label_format' => 'Name des Gebietes',
                    /*'label_attr' => [
                        'class' => 'text-black font-medium'
                    ]*/
                ]
            )
            ->add('slug',
                TextType::class,
                [
                    // 'row_attr' => ['class' => 'col-span-1 md:col-span-2'],
                    /*'attr' => [
                        'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                    ],*/
                    'label_format' => 'URL',
                    /*'label_attr' => [
                        'class' => 'text-gray-700 font-medium'
                    ]*/
                ]
            )
            ->add('orientation',
                ChoiceType::class,
                [
                    'label_format' => 'Wo im Umkreis von München',
                    'choices' => [
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
                    'label_format' => 'Reihenfolge',
                ]
            )
            ->add('online',
                ChoiceType::class, [
                    'label_format' => 'Online',
                    'choices' => [
                        'Ja' => 1,
                        'Nein' => 0,
                    ],
                ]
            )
            ->add('image',
                TextType::class,
                [
                    'label_format' => 'Bild',
                ]
            )
            ->add('header_image',
                TextType::class,
                [
                    'label_format' => 'Header Bild',
                ]
            )
            ->add('lat',
                FloatType::class,
                [
                    'label_format' => 'Breitengrad',
                ]
            )
            ->add('lng',
                TextType::class,
                [
                    'label_format' => 'Längengrad',
                ]
            )
            ->add('zoom',
                TextType::class,
                [
                    'label_format' => 'Zoom',
                ]
            )
            ->add('food', AreaAutocompleteField::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Area::class,
        ]);
    }
}
