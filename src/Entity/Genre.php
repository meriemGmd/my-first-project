<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, Anime>
     */
    #[ORM\ManyToMany(targetEntity: Anime::class, inversedBy: 'genres')]
    private Collection $anime_genre;

    public function __construct()
    {
        $this->anime_genre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Anime>
     */
    public function getAnimeGenre(): Collection
    {
        return $this->anime_genre;
    }

    public function addAnimeGenre(Anime $animeGenre): static
    {
        if (!$this->anime_genre->contains($animeGenre)) {
            $this->anime_genre->add($animeGenre);
        }

        return $this;
    }

    public function removeAnimeGenre(Anime $animeGenre): static
    {
        $this->anime_genre->removeElement($animeGenre);

        return $this;
    }
}
