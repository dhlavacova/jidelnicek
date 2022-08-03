<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]

/**
 * Reprezentuje záznamy databázové tabulky článků v redakčním systému.
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @UniqueEntity("url", message="Článek s touto URL adresou již existuje!")
 * @package App\Entity
 */
class Article
{
    /**
     * @var int Unikátní ID článku.
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[ORM\Id()]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;
    /**
     * @var string Titulek článku.
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Titulek článku nemůže být prázdný!")
     */
    #[ORM\Column(type: "string")]
    #[Assert\NotBlank(message: "titulek clanku muze byt prazdny")]
    private string $title;

    /**
     * @var string Text (obsah) článku.
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Obsah článku nemůže být prázdný!")
     */
    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message:"Obsah článku nemůže být prázdný!" )]
    private string $content;

    /**
     * @var string Unikátní URL adresa článku.
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank(message="URL adresa článku nemůže být prázdná!")
     */
    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'URL adresa clanku nemuze byt prazdna!')]
    private string $url;

    /**
     * @var string Krátký popis článku.
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Popis článku nemůže být prázdný!")
     */

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'Popis clanku nemuze byt prazdny!')]
    private string $description;
    /**
     * Getter pro ID článku.
     * @return int ID článku
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Setter pro titulek článku.
     * @param string|null $title titulek článku
     * @return Article sebe
     */
    public function setTitle(string $title = null): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Getter pro obsah článku.
     * @return null|string obsah článku
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Setter pro obsah článku.
     * @param string|null $content obsah článku
     * @return Article sebe
     */
    public function setContent(string $content = null): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Getter pro URL adresu článku.
     * @return null|string URL adresa článku
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Setter pro URL adresu článku.
     * @param string|null $url URL adresa článku
     * @return Article sebe
     */
    public function setUrl(string $url = null): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Getter pro popis článku.
     * @return null|string popis článku
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter pro popis článku.
     * @param string|null $description popis článku
     * @return Article sebe
     */
    public function setDescription(string $description = null): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
