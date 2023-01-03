<?php

namespace App\Entity;

use App\Repository\RoutesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: RoutesRepository::class)]
class Routes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull(message: 'Routenname darf nicht leer sein!')]
    #[Assert\Length(minMessage: 'Routenname sollte mehr als zwei Zeichen enthalten!', min: 2)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'routes', fetch: "EXTRA_LAZY")]
    private ?Area $area = null;

    #[ORM\ManyToOne(inversedBy: 'routes', fetch: "EXTRA_LAZY")]
    private ?Rock $rock = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private ?string $grade = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $climbed = false;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $firstAscent = null;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $yearFirstAscent = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $protection;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $scale = null;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $gradeNo = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $rating;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $topoId = null;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $nr = null;

    public function __toString(): string
    {
        return $this->name;
    }

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

    public function getArea(): ?Area
    {
        return $this->area;
    }

    public function setArea(?Area $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getRock(): ?Rock
    {
        return $this->rock;
    }

    public function setRock(?Rock $rock): self
    {
        $this->rock = $rock;

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
