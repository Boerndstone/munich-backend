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
     * @ORM\ManyToOne(targetEntity=Area::class, inversedBy="routes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $areaId;

    /**
     * @ORM\ManyToOne(targetEntity=Rock::class, inversedBy="routes")
     * @ORM\JoinColumn(name="rock_id_id", referencedColumnName="id")
     */
    private $rockId;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $grade;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $climbed;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstAscent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yearFirstAscent;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $protection;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $scale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gradeNo;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $topoId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nr;

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

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getClimbed(): ?bool
    {
        return $this->climbed;
    }

    public function setClimbed(?bool $climbed): self
    {
        $this->climbed = $climbed;

        return $this;
    }

    public function getFirstAscent(): ?string
    {
        return $this->firstAscent;
    }

    public function setFirstAscent(?string $firstAscent): self
    {
        $this->firstAscent = $firstAscent;

        return $this;
    }

    public function getYearFirstAscent(): ?int
    {
        return $this->yearFirstAscent;
    }

    public function setYearFirstAscent(?int $yearFirstAscent): self
    {
        $this->yearFirstAscent = $yearFirstAscent;

        return $this;
    }

    public function getProtection(): ?int
    {
        return $this->protection;
    }

    public function setProtection(?int $protection): self
    {
        $this->protection = $protection;

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

    public function getScale(): ?string
    {
        return $this->scale;
    }

    public function setScale(string $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function getGradeNo(): ?int
    {
        return $this->gradeNo;
    }

    public function setGradeNo(?int $gradeNo): self
    {
        $this->gradeNo = $gradeNo;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getTopoId(): ?int
    {
        return $this->topoId;
    }

    public function setTopoId(?int $topoId): self
    {
        $this->topoId = $topoId;

        return $this;
    }

    public function getNr(): ?int
    {
        return $this->nr;
    }

    public function setNr(?int $nr): self
    {
        $this->nr = $nr;

        return $this;
    }
}
