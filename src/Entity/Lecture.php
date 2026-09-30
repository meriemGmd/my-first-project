<?php

namespace App\Entity;

use App\Repository\LectureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LectureRepository::class)]
class Lecture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lectures')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'lectures')]
    private ?Anime $anime_id = null;

    #[ORM\ManyToOne(inversedBy: 'lectures')]
    private ?StatutLecture $statut_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getAnimeId(): ?Anime
    {
        return $this->anime_id;
    }

    public function setAnimeId(?Anime $anime_id): static
    {
        $this->anime_id = $anime_id;

        return $this;
    }

    public function getStatutId(): ?StatutLecture
    {
        return $this->statut_id;
    }

    public function setStatutId(?StatutLecture $statut_id): static
    {
        $this->statut_id = $statut_id;

        return $this;
    }
}
