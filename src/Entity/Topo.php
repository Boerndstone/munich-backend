<?php

namespace App\Entity;

use App\Repository\TopoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopoRepository::class)]
class Topo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'topo')]
    private ?Rock $rocks = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private bool $withSector = false;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $svg = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private int $number;

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
