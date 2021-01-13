<?php

namespace App\Form;

use App\Form\ModelType;
use App\Entity\Category;
use App\Entity\MachineType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', EntityType::class, [
                'label' => 'Catégorie',
                'choice_label' => 'name',
                'placeholder' => 'Selectionner une catégorie',
                'mapped' => false,
                'class' => Category::class,
            ]);
/*                 $builder
        ->add('creators', EntityType::class, [
            'class' => User::class,
            'choices'  => $this->userRepository->getCreatorsSubscribedToByUser($this->userProvider->getCurrentUser()),
            'choice_label' => 'name',
            'required' => false,
            'multiple' => true,
            'expanded' => true
        ])
    ; */
/*         $builder
            ->add('name', EntityType::class, [
                'label' => 'Catégorie',
                'choice_label' => 'name',
                'placeholder' => 'Selectionner une catégorie',
                'mapped' => false,
                'class' => Category::class,
            ]);

        $builder
            ->get('name')->addEventListener(
                FormEvents::POST_SUBMIT,
                function(FormEvent $event)
                {
                    $form = $event->getForm();
                    $form->getParent()->add('id', EntityType::class, [
                        'choices' => $form->getData()->getMachineTypes(),
                        'label' => 'Type',
                        'class' => MachineType::class,
                    ]);
                }
        ); */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
