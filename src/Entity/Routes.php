<?php

namespace App\Entity;

use App\Repository\RoutesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RoutesRepository::class)]
class Routes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Routenname darf nicht leer sein!')]
    #[Assert\Length(minMessage: 'Routenname sollte mehr als zwei Zeichen enthalten!', min: 2)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'routes', fetch: 'EXTRA_LAZY')]
    private ?Area $area = null;

    #[ORM\ManyToOne(inversedBy: 'routes', fetch: 'EXTRA_LAZY')]
    private ?Rock $rock = null;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    private ?string $grade = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private bool $climbed = false;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $firstAscent = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    protected ?int $yearFirstAscent = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $protection = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $scale = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    protected ?int $gradeNo = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $rating = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    protected ?int $topoId = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    protected ?int $nr = null;

    #[ORM\ManyToMany(targetEntity: ClimbedRoutes::class, mappedBy: 'ManyToMany')]
    private Collection $climbedRoutes;

    #[ORM\ManyToOne(inversedBy: 'realtion')]
    private ?FirstAscencionist $relatesToRoute = null;

    #[ORM\OneToMany(mappedBy: 'route', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToOne(inversedBy: 'routes', fetch: 'EXTRA_LAZY')]
    private ?Topo $topo = null;

    #[ORM\Column(nullable: true)]
    private ?bool $rockQuality = null;

    public function __construct()
    {
        $this->climbedRoutes = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function __toString(): string
    {
        $rockName = $this->getRock() ? $this->getRock()->getName() : 'No rock';
        $areaName = $this->getArea() ? $this->getArea()->getName() : 'No area';
        $routeName = $this->getName() ? $this->getName() : 'No route';

        return $routeName . ' - ' . $rockName . ' - ' . $areaName;
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

    /**
     * @return Collection<int, ClimbedRoutes>
     */
    public function getClimbedRoutes(): Collection
    {
        return $this->climbedRoutes;
    }

    public function addClimbedRoute(ClimbedRoutes $climbedRoute): self
    {
        if (!$this->climbedRoutes->contains($climbedRoute)) {
            $this->climbedRoutes->add($climbedRoute);
            $climbedRoute->addManyToMany($this);
        }

        return $this;
    }

    public function removeClimbedRoute(ClimbedRoutes $climbedRoute): self
    {
        if ($this->climbedRoutes->removeElement($climbedRoute)) {
            $climbedRoute->removeManyToMany($this);
        }

        return $this;
    }

    public function getRelatesToRoute(): ?FirstAscencionist
    {
        return $this->relatesToRoute;
    }

    public function setRelatesToRoute(?FirstAscencionist $relatesToRoute): static
    {
        $this->relatesToRoute = $relatesToRoute;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setRoute($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRoute() === $this) {
                $comment->setRoute(null);
            }
        }

        return $this;
    }

    public function getTopo(): ?Topo
    {
        return $this->topo;
    }

    public function setTopo(?Topo $topo): self
    {
        $this->topo = $topo;

        return $this;
    }

    public function isRockQuality(): ?bool
    {
        return $this->rockQuality;
    }

    public function setRockQuality(?bool $rockQuality): static
    {
        $this->rockQuality = $rockQuality;

        return $this;
    }
}
