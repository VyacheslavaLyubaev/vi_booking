<?php

namespace App\Entity;

use App\DTO\CustomerDTO;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
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
    private $f;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $i;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $o;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $ps;

    /**
     * @ORM\Column(type="integer", length=6)
     */
    private $pn;

    public function __construct(string $f, string $i, string $o, int $ps, int $pn)
    {
        $this->f = $f;
        $this->i = $i;
        $this->o = $o;
        $this->ps = $ps;
        $this->pn = $pn;
    }

    public function createFromDTO(CustomerDTO $dto): self
    {
        return new self($dto->getF(), $dto->getI(), $dto->getO(), $dto->getPs(), $dto->getPn());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getF(): ?string
    {
        return $this->f;
    }

    public function setF(string $f): self
    {
        $this->f = $f;

        return $this;
    }

    public function getI(): ?string
    {
        return $this->i;
    }

    public function setI(string $i): self
    {
        $this->i = $i;

        return $this;
    }

    public function getO(): ?string
    {
        return $this->o;
    }

    public function setO(string $o): self
    {
        $this->o = $o;

        return $this;
    }

    public function getPs(): ?string
    {
        return $this->ps;
    }

    public function setPs(string $ps): self
    {
        $this->ps = $ps;

        return $this;
    }

    public function getPn(): ?string
    {
        return $this->pn;
    }

    public function setPn(string $pn): self
    {
        $this->pn = $pn;

        return $this;
    }
}
