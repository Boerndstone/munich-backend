<?php

namespace App\Entity;

use App\Repository\GalerieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GalerieRepository::class)
 */
class Galerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Area::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $belongsToArea;

    /**
     * @ORM\ManyToOne(targetEntity=Rock::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $belongsToRock;

    /**
     * @ORM\ManyToOne(targetEntity=Routes::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $belongsToRoute;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photographer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBelongsToArea(): ?Area
    {
        return $this->belongsToArea;
    }

    public function setBelongsToArea(?Area $belongsToArea): self
    {
        $this->belongsToArea = $belongsToArea;

        return $this;
    }

    public function getBelongsToRock(): ?Rock
    {
        return $this->belongsToRock;
    }

    public function setBelongsToRock(?Rock $belongsToRock): self
    {
        $this->belongsToRock = $belongsToRock;

        return $this;
    }

    public function getBelongsToRoute(): ?Routes
    {
        return $this->belongsToRoute;
    }

    public function setBelongsToRoute(?Routes $belongsToRoute): self
    {
        $this->belongsToRoute = $belongsToRoute;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhotographer(): ?string
    {
        return $this->photographer;
    }

    public function setPhotographer(?string $photographer): self
    {
        $this->photographer = $photographer;

        return $this;
    }
}
