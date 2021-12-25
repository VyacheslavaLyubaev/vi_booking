<?php

namespace App\DTO;

use App\Entity\Customer;
use App\Entity\Flight;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class TicketDTO
{
    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     */
    private ?Flight $flight;
    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     */
    private ?Customer $customer;
    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     */
    private ?DateTime $flight_date;

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): void
    {
        $this->flight = $flight;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getFlightDate(): ?DateTime
    {
        return $this->flight_date;
    }

    public function setFlightDate(?DateTime $flight_date): void
    {
        $this->flight_date = $flight_date;
    }


}