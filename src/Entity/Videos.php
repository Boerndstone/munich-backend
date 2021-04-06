<?php

namespace App\Entity;

use App\Repository\VideosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideosRepository::class)
 */
class Videos
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
    private $videoArea;

    /**
     * @ORM\ManyToOne(targetEntity=Rock::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $videoRocks;

    /**
     * @ORM\ManyToOne(targetEntity=Routes::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $videoRoutes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $videoLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoArea(): ?Area
    {
        return $this->videoArea;
    }

    public function setVideoArea(?Area $videoArea): self
    {
        $this->videoArea = $videoArea;

        return $this;
    }

    public function getVideoRocks(): ?Rock
    {
        return $this->videoRocks;
    }

    public function setVideoRocks(?Rock $videoRocks): self
    {
        $this->videoRocks = $videoRocks;

        return $this;
    }

    public function getVideoRoutes(): ?Routes
    {
        return $this->videoRoutes;
    }

    public function setVideoRoutes(?Routes $videoRoutes): self
    {
        $this->videoRoutes = $videoRoutes;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(string $videoLink): self
    {
        $this->videoLink = $videoLink;

        return $this;
    }
}
