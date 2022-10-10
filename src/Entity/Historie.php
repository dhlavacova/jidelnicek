<?php

namespace App\Entity;

use App\Repository\HistorieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistorieRepository::class)]
class Historie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE,unique: true)]
    private ?\DateTimeInterface $datum = null;

    #[ORM\ManyToOne]
    private ?NazevJidla $fruestueck = null;

    #[ORM\ManyToOne]
    private ?NazevJidla $snack = null;

    #[ORM\ManyToOne(inversedBy: 'histories')]
    private ?NazevJidla $mittagessen = null;

    #[ORM\ManyToOne]
    private ?NazevJidla $abendsbrot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getFruestueck(): ?NazevJidla
    {
        return $this->fruestueck;
    }

    public function setFruestueck(?NazevJidla $fruestueck): self
    {
        $this->fruestueck = $fruestueck;

        return $this;
    }

    public function getSnack(): ?NazevJidla
    {
        return $this->snack;
    }

    public function setSnack(?NazevJidla $snack): self
    {
        $this->snack = $snack;

        return $this;
    }

    public function getMittagessen(): ?NazevJidla
    {
        return $this->mittagessen;
    }

    public function setMittagessen(?NazevJidla $mittagessen): self
    {
        $this->mittagessen = $mittagessen;

        return $this;
    }

    public function getAbendsbrot(): ?NazevJidla
    {
        return $this->abendsbrot;
    }

    public function setAbendsbrot(?NazevJidla $abendsbrot): self
    {
        $this->abendsbrot = $abendsbrot;

        return $this;
    }

}
