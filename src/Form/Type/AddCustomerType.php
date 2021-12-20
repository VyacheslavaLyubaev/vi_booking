<?php

namespace App\Form\Type;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('f', TextType::class, ['label' => 'Фамилия'])
            ->add('i', TextType::class, ['label' => 'Имя'])
            ->add('o', TextType::class, ['label' => 'Отчество'])
            ->add('ps', TextType::class, ['label' => 'Серия'])
            ->add('pn', TextType::class, ['label' => 'Номер'])
            ->add('save', SubmitType::class, ['label' => 'Добавить']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}