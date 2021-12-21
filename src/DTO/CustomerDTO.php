<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CustomerDTO
{
    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max="31", maxMessage="Вы привысили допустимое количество символов - 31")
     */
    private ?string $f;

    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max="31", maxMessage="Вы привысили допустимое количество символов - 31")
     */
    private ?string $i;

    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max="31", maxMessage="Вы привысили допустимое количество символов - 31")
     */
    private ?string $o;

    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max="4", maxMessage="Вы привысили допустимое количество символов - 4")
     * @Assert\Length(min="4",minMessage="Необходимое количество символов - 4")
     */
    private ?int $ps;

    /**
     * @Assert\NotBlank(message="Поле должно быть заполнено")
     * @Assert\Length(max="6", maxMessage="Вы привысили допустимое количество символов - 6")
     * @Assert\Length(min="6",minMessage="Необходимое количество символов - 6")
     */
    private ?int $pn;


    public function getF(): ?string
    {
        return $this->f;
    }


    public function setF(?string $f): void
    {
        $this->f = $f;
    }


    public function getI(): ?string
    {
        return $this->i;
    }


    public function setI(?string $i): void
    {
        $this->i = $i;
    }


    public function getO(): ?string
    {
        return $this->o;
    }


    public function setO(?string $o): void
    {
        $this->o = $o;
    }


    public function getPs(): ?int
    {
        return $this->ps;
    }


    public function setPs(?int $ps): void
    {
        $this->ps = $ps;
    }


    public function getPn(): ?int
    {
        return $this->pn;
    }


    public function setPn(?int $pn): void
    {
        $this->pn = $pn;
    }


}