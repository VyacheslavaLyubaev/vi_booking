<?php

namespace App\Form\Type;

use App\DTO\CustomerDTO;
use App\Entity\Customer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class BookTicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label'  => 'Дата',
                'widget' => 'single_text'
            ])
            ->add('customer1', EntityType::class, [
                'class' => Customer::class,
                'label' => 'Рейс'
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'label' => 'Пассажир'
            ])
            ->add('save', SubmitType::class, ['label' => 'Добавить']);
    }


}