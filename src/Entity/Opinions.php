<?php

namespace App\Entity;

use App\Repository\OpinionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OpinionsRepository::class)
 */
class Opinions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentary;

    /**
     * @ORM\Column(type="integer")
     */
    private $stars;

    /**
     * @ORM\Column(type="date")
     */
    private $publication_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="opinion")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Movies::class, inversedBy="opinion")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $movies;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="opinion")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getMovies(): ?Movies
    {
        return $this->movies;
    }

    public function setMovies(?Movies $movies): self
    {
        $this->movies = $movies;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString() :string {
        return $this->commentary;
    }
}
