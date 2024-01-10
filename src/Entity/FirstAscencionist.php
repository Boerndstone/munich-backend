<?php

namespace App\Entity;

use App\Repository\FirstAscencionistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FirstAscencionistRepository::class)]
class FirstAscencionist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\OneToMany(mappedBy: 'relatesToRoute', targetEntity: Routes::class)]
    private Collection $realtion;

    public function __construct()
    {
        $this->realtion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<int, Routes>
     */
    public function getRealtion(): Collection
    {
        return $this->realtion;
    }

    public function addRealtion(Routes $realtion): static
    {
        if (!$this->realtion->contains($realtion)) {
            $this->realtion->add($realtion);
            $realtion->setRelatesToRoute($this);
        }

        return $this;
    }

    public function removeRealtion(Routes $realtion): static
    {
        if ($this->realtion->removeElement($realtion)) {
            // set the owning side to null (unless already changed)
            if ($realtion->getRelatesToRoute() === $this) {
                $realtion->setRelatesToRoute(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
