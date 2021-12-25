<?php

namespace App\Entity;

use App\Repository\AirportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirportRepository::class)
 */
class Airport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $airport_code;

    /**
     * @var Flight[]
     * @ORM\OneToMany(targetEntity=Flight::class, mappedBy="departure_airport")
     */
    private $flights_departure;

    /**
     * var Flight[]
     * @ORM\OneToMany(targetEntity=Flight::class, mappedBy="arrival_airport")
     */
    private $flights_arrival;

    public function __construct()
    {
        $this->flights_departure = new ArrayCollection();
        $this->flights_arrival = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAirportCode(): ?string
    {
        return $this->airport_code;
    }

    public function setAirportCode(string $airport_code): self
    {
        $this->airport_code = $airport_code;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlightsDeparture(): Collection
    {
        return $this->flights_departure;
    }

    public function addFlightsDeparture(Flight $flightsDeparture): self
    {
        if (!$this->flights_departure->contains($flightsDeparture)) {
            $this->flights_departure[] = $flightsDeparture;
            $flightsDeparture->setDepartureAirport($this);
        }

        return $this;
    }

    public function removeFlightsDeparture(Flight $flightsDeparture): self
    {
        if ($this->flights_departure->removeElement($flightsDeparture)) {
            // set the owning side to null (unless already changed)
            if ($flightsDeparture->getDepartureAirport() === $this) {
                $flightsDeparture->setDepartureAirport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlightsArrival(): Collection
    {
        return $this->flights_arrival;
    }

    public function addFlightsArrival(Flight $flightsArrival): self
    {
        if (!$this->flights_arrival->contains($flightsArrival)) {
            $this->flights_arrival[] = $flightsArrival;
            $flightsArrival->setArrivalAirport($this);
        }

        return $this;
    }

    public function removeFlightsArrival(Flight $flightsArrival): self
    {
        if ($this->flights_arrival->removeElement($flightsArrival)) {
            // set the owning side to null (unless already changed)
            if ($flightsArrival->getArrivalAirport() === $this) {
                $flightsArrival->setArrivalAirport(null);
            }
        }

        return $this;
    }



}
