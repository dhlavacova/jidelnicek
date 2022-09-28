<?php

namespace App\Entity;

use App\Repository\NazevJidlaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NazevJidlaRepository::class)]
class NazevJidla
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'nemuze byt prazdny')]
    private ?string $nazev = null;

    #[ORM\ManyToMany(targetEntity: DruhJidla::class, inversedBy: 'jidla')]
    private Collection $druhy;

    public function __construct()
    {
        $this->druhy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): self
    {
        $this->nazev = $nazev;

        return $this;
    }

    /**
     * @return Collection<int, DruhJidla>
     */
    public function getDruhy(): Collection
    {
        return $this->druhy;
    }

    public function addDruhy(DruhJidla $druhy): self
    {
        if (!$this->druhy->contains($druhy)) {
            $this->druhy[] = $druhy;
        }

        return $this;
    }

    public function removeDruhy(DruhJidla $druhy): self
    {
        $this->druhy->removeElement($druhy);

        return $this;
    }
}
