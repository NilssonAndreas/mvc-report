<?php

namespace App\Entity;

use App\Repository\LeaderboardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeaderboardRepository::class)]
class Leaderboard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $namn;

    #[ORM\Column(type: 'string', length: 255)]
    private $alias;

    #[ORM\Column(type: 'string', length: 100)]
    private $land;

    #[ORM\Column(type: 'integer')]
    private $score;

    #[ORM\Column(type: 'text', nullable: true)]
    private $bio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamn(): ?string
    {
        return $this->namn;
    }

    public function setNamn(string $namn): self
    {
        $this->namn = $namn;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getLand(): ?string
    {
        return $this->land;
    }

    public function setLand(string $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore($score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio($bio): self
    {
        $this->bio = $bio;

        return $this;
    }
}
