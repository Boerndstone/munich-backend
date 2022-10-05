<?php

namespace App\Entity;

use App\Repository\RockRepository;
use App\Repository\RoutesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RockRepository::class)
 */
class Rock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("rocks")
     * @Assert\NotNull(message="Felsname darf nicht leer sein!")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Felsname sollte mehr als zwei Zeichen enthalten!",
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Routes::class, mappedBy="rock", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"nr" = "ASC"})
     */
    private $routes;

    /**
     * @ORM\ManyToOne(targetEntity=Area::class, inversedBy="rocks", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="URL darf nicht leer sein und darf keine Umlaute enthalten!")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "URL sollte mehr als zwei Zeichen enthalten!",
     * )
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("rocks")
     */
    private $nr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $access;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $nature;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $zone;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $banned;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $orientation;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $season;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $childFriendly;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $sunny;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $rain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $headerImage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $topo;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6, nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6, nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $online;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getArea(): ?Area
    {
        return $this->area;
    }

    public function setArea(?Area $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function __toString(){
        return $this->getName();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAccess(): ?string
    {
        return $this->access;
    }

    public function setAccess(?string $access): self
    {
        $this->access = $access;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(?string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getZone(): ?int
    {
        return $this->zone;
    }

    public function setZone(?int $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getBanned(): ?int
    {
        return $this->banned;
    }

    public function setBanned(?int $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(?string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(?string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getchildFriendly(): ?string
    {
        return $this->childFriendly;
    }

    public function setchildFriendly(?string $childFriendly): self
    {
        $this->childFriendly = $childFriendly;

        return $this;
    }

    public function getSunny(): ?int
    {
        return $this->sunny;
    }

    public function setSunny(?int $sunny): self
    {
        $this->sunny = $sunny;

        return $this;
    }

    public function getRain(): ?int
    {
        return $this->rain;
    }

    public function setRain(?int $rain): self
    {
        $this->rain = $rain;

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

    public function getHeaderImage(): ?string
    {
        return $this->headerImage;
    }

    public function setHeaderImage(?string $headerImage): self
    {
        $this->headerImage = $headerImage;

        return $this;
    }

    public function getTopo(): ?int
    {
        return $this->topo;
    }

    public function setTopo(?int $topo): self
    {
        $this->topo = $topo;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(?bool $online): self
    {
        $this->online = $online;

        return $this;
    }

    public function __construct()
    {
        $this->routes = new ArrayCollection();
    }

    /**
     * @return Collection|Routes[]
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

}
