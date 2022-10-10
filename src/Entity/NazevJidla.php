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

    #[ORM\OneToMany(mappedBy: 'mittagessen', targetEntity: Historie::class)]
    private Collection $histories;

    public function __construct()
    {
        $this->druhy = new ArrayCollection();
        $this->histories = new ArrayCollection();
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

    /**
     * @return Collection<int, Historie>
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(Historie $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories->add($history);
            $history->setMittagessen($this);
        }

        return $this;
    }

    public function removeHistory(Historie $history): self
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getMittagessen() === $this) {
                $history->setMittagessen(null);
            }
        }

        return $this;
    }
}
