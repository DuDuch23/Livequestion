<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'reponse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\ManyToOne(inversedBy: 'reponse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTimeElapsed(): string
    {
        $now = new DateTime();
        $diff = $now->diff($this->createdAt);

        if ($diff->y > 0) 
        {
            return $diff->y . ' ' . ($diff->y > 1 ? 'années' : 'année');
        }
        elseif ($diff->m > 0) 
        {
            return $diff->m . ' ' . ($diff->m > 1 ? 'mois' : 'mois');
        }
        elseif ($diff->d > 0) 
        {
            return $diff->d . ' ' . ($diff->d > 1 ? 'jours' : 'jour');
        }
        elseif ($diff->h > 0) 
        {
            return $diff->h . ' ' . ($diff->h > 1 ? 'heures' : 'heure');
        }
        elseif ($diff->i > 0) 
        {
            return $diff->i . ' ' . ($diff->i > 1 ? 'minutes' : 'minute');
        }
        else
        {
            return $diff->s . ' ' . ($diff->s > 1 ? 'secondes' : 'seconde');
        }
    }
}
