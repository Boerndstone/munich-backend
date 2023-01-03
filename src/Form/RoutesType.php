<?php

namespace App\Form;

use App\Entity\Area;
use App\Entity\Rock;
use App\Entity\Routes;
use App\Repository\AreaRepository;
use App\Repository\RockRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoutesType extends AbstractType
{
    public function __construct(AreaRepository $areaRepository, RockRepository $rockRepository)
    {
        $this->areaRepository = $areaRepository;
        $this->rockRepository = $rockRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                TextType::class,
                [
                    'label_format' => 'Name der Tour',
                ]
            )
            ->add('area',
                ChoiceType::class,
                [
                    'label_format' => 'Gebiet',
                    'choice_label' => function (Area $area) {
                        return sprintf('(%d) %s', $area->getOnline(), $area->getName());
                    },
                    'choices' => $this->areaRepository->findAllAreasAlphabetical(),
                ]
            )
            ->add('rock',
                ChoiceType::class,
                [
                    'label_format' => 'Fels',
                    'choice_label' => function (Rock $rock) {
                        return sprintf('(%d) %s', $rock->getOnline(), $rock->getName());
                    },
                    'choices' => $this->rockRepository->findAllRocksAlphabetical(),
                ]
            )
            ->add('grade',
                TextType::class,
                [
                    'label_format' => 'Schwierigkeitsgrad',
                ]
            )
            ->add('climbed',
                ChoiceType::class, [
                    'label_format' => 'Bereits geklettert',
                    'choices' => [
                        'Nein' => 0,
                        'Ja' => 1,
                    ],
                ]
            )
            ->add('firstAscent',
                TextType::class, [
                    'label_format' => 'Erstbegeher',
                    'required' => false,
                ]
            )
            ->add('yearFirstAscent',
                TextType::class, [
                    'label_format' => 'Jahr der Erstbegehung',
                ]
            )
            ->add('protection',
                TextType::class, [
                    'label_format' => 'Absicherung',
                ]
            )
            ->add('description',
                TextareaType::class, [
                    'attr' => [
                        'rows' => 5,
                    ],
                    'label_format' => 'Beschreibung',
                ]
            )
            ->add('scale',
                TextType::class, [
                    'label_format' => 'Skala',
                ]
            )
            ->add('gradeNo',
                TextType::class, [
                    'label_format' => 'Grad',
                ]
            )
            ->add('rating',
                TextType::class, [
                    'label_format' => 'Schönheit',
                ]
            )
            ->add('topoId',
                TextType::class, [
                    'label_format' => 'Topo ID',
                ]
            )
            ->add('nr',
                TextType::class, [
                    'label_format' => 'Nummer',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Routes::class,
        ]);
    }
}
