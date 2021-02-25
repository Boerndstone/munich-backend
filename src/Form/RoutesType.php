<?php

namespace App\Form;

use App\Entity\Routes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoutesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                TextType::class,
                    [
                        'row_attr' => ['class' => 'my-4 col-span-4'],
                        'attr' => [
                            'class' => 'mt-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded py-2 px-4 block w-full focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring',
                        ],
                        'label_format' => 'Name der Tour',
                        'label_attr' => [
                            'class' => 'text-gray-700 font-medium'
                        ],
                        
                    ]
            )
            ->add('areaId')
            ->add('rockId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Routes::class,
        ]);
    }
}
