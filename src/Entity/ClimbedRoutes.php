<?php

namespace App\Entity;

use App\Repository\ClimbedRoutesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClimbedRoutesRepository::class)]
class ClimbedRoutes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'routes')]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Routes::class, inversedBy: 'climbedRoutes')]
    private Collection $ManyToMany;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column]
    private ?int $routeId = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->ManyToMany = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Routes>
     */
    public function getManyToMany(): Collection
    {
        return $this->ManyToMany;
    }

    public function addManyToMany(Routes $manyToMany): self
    {
        if (!$this->ManyToMany->contains($manyToMany)) {
            $this->ManyToMany->add($manyToMany);
        }

        return $this;
    }

    public function removeManyToMany(Routes $manyToMany): self
    {
        $this->ManyToMany->removeElement($manyToMany);

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getRouteId(): ?int
    {
        return $this->routeId;
    }

    public function setRouteId(int $routeId): self
    {
        $this->routeId = $routeId;

        return $this;
    }
}
