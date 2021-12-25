<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
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
    private $flight_number;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="flights_departure")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $departure_airport;

    /**
     * @ORM\ManyToOne(targetEntity=Airport::class, inversedBy="flights_arrival")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $arrival_airport;

    /**
     * @ORM\Column(type="time")
     */
    private $flight_time;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $base_price;


    public function __construct()
    {
        $this->ticket = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightNumber(): ?string
    {
        return $this->flight_number;
    }

    public function setFlightNumber(string $flight_number): self
    {
        $this->flight_number = $flight_number;

        return $this;
    }

    public function getDepartureAirport(): Airport
    {
        return $this->departure_airport;
    }

    public function setDepartureAirport(?Airport $departure_airport): self
    {
        $this->departure_airport = $departure_airport;

        return $this;
    }

    public function getArrivalAirport(): Airport
    {
        return $this->arrival_airport;
    }

    public function setArrivalAirport(?Airport $arrival_airport): self
    {
        $this->arrival_airport = $arrival_airport;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBasePrice(): ?int
    {
        return $this->base_price;
    }

    public function setBasePrice(int $base_price): self
    {
        $this->base_price = $base_price;

        return $this;
    }

    public function getFlightTime(): ?\DateTimeInterface
    {
        return $this->flight_time;
    }

    public function setFlightTime(\DateTimeInterface $flight_time): self
    {
        $this->flight_time = $flight_time;

        return $this;
    }

    public function getFlightData(): string
    {
        $format = '%s (%s) - %s (%s)';
        $flightData = sprintf(
            $format,
            $this->getDepartureAirport()->getCity(),
            $this->getDepartureAirport()->getAirportCode(),
            $this->getArrivalAirport()->getCity(),
            $this->getArrivalAirport()->getAirportCode()
        );
        return $flightData;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTicket(): Collection
    {
        return $this->ticket;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->ticket->contains($ticket)) {
            $this->ticket[] = $ticket;
            $ticket->setPassenger($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->ticket->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getPassenger() === $this) {
                $ticket->setPassenger(null);
            }
        }

        return $this;
    }

}
