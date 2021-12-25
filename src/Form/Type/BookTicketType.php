<?php

namespace App\Form\Type;

use App\DTO\TicketDTO;
use App\Entity\Customer;
use App\Entity\Flight;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookTicketType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('flightDate', DateType::class, [
                'label'  => 'Дата',
                'widget' => 'single_text'
            ])
            ->add('flight', EntityType::class,[
                'label' => 'Рейс',
                'class' => Flight::class,
                'choice_label' => function ($flight)
                {
                    return $flight->getFlightData();
                }
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'label' => 'Пассажир'
            ])
            ->add('save', SubmitType::class, ['label' => 'Купить']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TicketDTO::class
        ])
        ->setRequired('activeFlight');
    }

}
