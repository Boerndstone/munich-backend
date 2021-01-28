<?php

namespace App\Entity;

use App\Repository\RoutesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoutesRepository::class)
 */
class Routes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Area::class)
     */
    private $areaId;

    /**
     * @ORM\ManyToOne(targetEntity=Rock::class)
     */
    private $rockId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAreaId(): ?Area
    {
        return $this->areaId;
    }

    public function setAreaId(?Area $areaId): self
    {
        $this->areaId = $areaId;

        return $this;
    }

    public function getRockId(): ?Rock
    {
        return $this->rockId;
    }

    public function setRockId(?Rock $rockId): self
    {
        $this->rockId = $rockId;

        return $this;
    }
}
