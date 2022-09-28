<?php

namespace App\Entity;

use App\Repository\DruhJidlaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DruhJidlaRepository::class)]
class DruhJidla
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: NazevJidla::class, mappedBy: 'druhy')]
    private Collection $jidla;

    #[ORM\Column(length: 255)]
    private ?string $kategorie = null;

    public function __construct()
    {
        $this->jidla = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, NazevJidla>
     */
    public function getJidla(): Collection
    {
        return $this->jidla;
    }

    public function addJidla(NazevJidla $jidla): self
    {
        if (!$this->jidla->contains($jidla)) {
            $this->jidla[] = $jidla;
            $jidla->addDruhy($this);
        }

        return $this;
    }

    public function removeJidla(NazevJidla $jidla): self
    {
        if ($this->jidla->removeElement($jidla)) {
            $jidla->removeDruhy($this);
        }

        return $this;
    }

    public function getKategorie(): ?string
    {
        return $this->kategorie;
    }

    public function setKategorie(string $kategorie): self
    {
        $this->kategorie = $kategorie;

        return $this;
    }
}
