<?php

namespace App\DTO;



use Symfony\Component\HttpFoundation\Request;

class FlightDTO
{
    private int $id;
    private string $departure_airport;
    private string $arrival_airport;

    public function __construct(int $id, string $departure_airport, string $arrival_airport)
    {

        $this->id = $id;
        $this->departure_airport = $departure_airport;
        $this->arrival_airport = $arrival_airport;
    }

    public static function createFromEntity(Request $request): self
    {
        $dto = new self();

        $dto->getId();
        $dto->getDepartureAirport();
        $dto->getArrivalAirport();

        return $dto;

    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getDepartureAirport(): string
    {
        return $this->departure_airport;
    }


    public function setDepartureAirport(string $departure_airport): void
    {
        $this->departure_airport = $departure_airport;
    }


    public function getArrivalAirport(): string
    {
        return $this->arrival_airport;
    }


    public function setArrivalAirport(string $arrival_airport): void
    {
        $this->arrival_airport = $arrival_airport;
    }

}