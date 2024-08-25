<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTime;
// use Carbon\Carbon;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[Vich\Uploadable]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $nb_answer = null;

    #[Vich\UploadableField(mapping: 'question_image', fileNameProperty: 'imageNameQuestion')]
    private ?File $imageFileQuestion = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageNameQuestion = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToOne(targetEntity: Thematic::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Thematic $thematic_id = null;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getNbAnswer(): ?int
    {
        return $this->nb_answer;
    }

    public function setNbAnswer(int $nb_answer): static
    {
        $this->nb_answer = $nb_answer;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFileQuestion
     */

     public function setImageFileQuestion(?File $imageFileQuestion = null): void
     {
         $this->imageFileQuestion = $imageFileQuestion;
     }
 
     public function getImageFileQuestion(): ?File
     {
         return $this->imageFileQuestion;
     }
 
     public function setImageNameQuestion(?string $imageNameQuestion): void
     {
         $this->imageNameQuestion = $imageNameQuestion;
     }
 
     public function getImageNameQuestion(): ?string
     {
         return $this->imageNameQuestion;
     }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getThematicId(): ?Thematic
    {
        return $this->thematic_id;
    }

    public function setThematicId(?Thematic $thematic_id): static
    {
        $this->thematic_id = $thematic_id;

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

    // public function getTimeElapsed(): string
    // {
    //     return Carbon::instance($this->createdAt)->diffForHumans();
    // }
}
