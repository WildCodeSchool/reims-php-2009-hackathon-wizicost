<?php

namespace App\Form;

use App\Entity\Resource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ResourceModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', null, ['choice_label' => 'nameModel'])
            ->add('cost', NumberType::class, [
                'invalid_message' => 'Valeur invalide'
            ])
            ->add('residualvalue', ChoiceType::class, [
                'choices'  => [
                    'Recent' => 'recent',
                    'Moyen' => 'moyen',
                    'Vieu' => 'vieu',
                ],
                'label' => 'Anciennete du vehicule'
            ])
            ->add('worktime', ChoiceType::class, [
                'choices'  => [
                    'Peu' => '400',
                    'Moyen' => '800',
                    'Beaucoup' => '1200',
                ],
                'label' => 'Utilisation du vehicule'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resource::class,
        ]);
    }
}
