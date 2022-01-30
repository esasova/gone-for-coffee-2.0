<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoffeeshopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CoffeeshopRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"coffeeshop", "coffeeshop:read"}},
 *  denormalizationContext={"groups"={"coffeeshop", "coffeeshop:write"}}
 * )
 */
class Coffeeshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"coffeeshop", "user:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"coffeeshop", "user:read"})
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?string $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?string $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?string $postcode;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?bool $brunch;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?bool $sunday;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private ?string $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"coffeeshop"})
     */
    private ?string $website;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="coffeeshop", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"coffeeshop"})
     */
    private Collection $ratings;

    /**
     * @ORM\OneToMany(targetEntity=Timeline::class, mappedBy="coffeeshop", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"coffeeshop"})
     */
    private Collection $timetable;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups({"coffeeshop"})
     *
     * @var array<string>|null
     */
    private ?array $coordinates = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $image;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
        $this->timetable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBrunch(): ?bool
    {
        return $this->brunch;
    }

    public function setBrunch(?bool $brunch): self
    {
        $this->brunch = $brunch;

        return $this;
    }

    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    public function setSunday(?bool $sunday): self
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setCoffeeshop($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getCoffeeshop() === $this) {
                $rating->setCoffeeshop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Timeline[]
     */
    public function getTimetable(): Collection
    {
        return $this->timetable;
    }

    public function addTimetable(Timeline $timeline): self
    {
        if (!$this->timetable->contains($timeline)) {
            $this->timetable[] = $timeline;
            $timeline->setCoffeeshop($this);
        }

        return $this;
    }

    public function removeTimetable(Timeline $timeline): self
    {
        if ($this->timetable->removeElement($timeline)) {
            // set the owning side to null (unless already changed)
            if ($timeline->getCoffeeshop() === $this) {
                $timeline->setCoffeeshop(null);
            }
        }

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    /**
     * @param array<string>|null $coordinates
     */
    public function setCoordinates(?array $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
