<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 15)]
    private $videoId;

    #[ORM\Column(type: 'integer')]
    private $start;

    #[ORM\Column(type: 'integer')]
    private $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    public function setVideoId(string $videoId): self
    {
        $this->videoId = $videoId;

        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?int
    {
        return $this->end;
    }

    public function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }
}
