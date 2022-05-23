<?php

namespace App\Entity;

use App\Repository\ProjRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjRepository::class)]
/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class Proj
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id; /*@phpstan-ignore-line*/

    #[ORM\Column(type: 'string', length: 255)]
    private $namn;

    #[ORM\Column(type: 'string', length: 255)]
    private $alias;

    #[ORM\Column(type: 'integer')]
    private $score;

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

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
