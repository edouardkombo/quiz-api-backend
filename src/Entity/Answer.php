<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
#[ApiResource]
#[ApiResource(
    normalizationContext: ['groups' => ['read'], 'enable_max_depth' => true],
    denormalizationContext: ['groups' => ['write'], 'enable_max_depth' => true],
    uriTemplate: '/questions/{questionId}/answers',
    uriVariables: [
        'questionId' => new Link(fromClass: Question::class, fromProperty: 'answers'),
    ],
    operations: [
        new GetCollection()
    ]
)]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    uriTemplate: '/answers/{answerId}/points',
    uriVariables: [
        'answerId' => new Link(fromClass: Point::class, fromProperty: 'value'),
    ],
    operations: [
        new Get()
    ]
)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read", "write"])]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: true)]
    #[Link(toProperty: 'answers')]
    #[Groups(["read", "write"])]
    private ?Question $question = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[Groups(["read", "write"])]
    private ?Point $value = null;

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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getValue(): ?Point
    {
        return $this->value;
    }

    public function setValue(?Point $value): static
    {
        $this->value = $value;

        return $this;
    }
}
