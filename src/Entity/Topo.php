<?php

namespace App\Entity;

use App\Repository\TopoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TopoRepository::class)
 */
class Topo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Rock::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $rocks;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withSector;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $svg;

    /**
     * @ORM\Column(type="smallint")
     */
    private $number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRocks(): ?Rock
    {
        return $this->rocks;
    }

    public function setRocks(?Rock $rocks): self
    {
        $this->rocks = $rocks;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getWithSector(): ?bool
    {
        return $this->withSector;
    }

    public function setWithSector(?bool $withSector): self
    {
        $this->withSector = $withSector;

        return $this;
    }

    public function getSvg(): ?string
    {
        return $this->svg;
    }

    public function setSvg(?string $svg): self
    {
        $this->svg = $svg;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
