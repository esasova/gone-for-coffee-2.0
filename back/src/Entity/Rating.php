<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RatingRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"rating", "rating:read"}},
 *  denormalizationContext={"groups"={"rating", "rating:write"}}
 * )
 */
class Rating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "coffeeshop:read", "rating:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "coffeeshop:read", "rating"})
     */
    private int $rating;

    /**
     * @ORM\ManyToOne(targetEntity=Coffeeshop::class, inversedBy="ratings")
     * @Groups({"user:read", "rating"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?Coffeeshop $coffeeshop;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ratings")
     * @Groups({"coffeeshop:read", "rating"})
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCoffeeshop(): ?Coffeeshop
    {
        return $this->coffeeshop;
    }

    public function setCoffeeshop(?Coffeeshop $coffeeshop): self
    {
        $this->coffeeshop = $coffeeshop;

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
}
