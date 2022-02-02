<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TimelineRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TimelineRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"timeline", "timeline:read"}},
 *  denormalizationContext={"groups"={"timeline", "timeline:write"}}
 * )
 */
class Timeline
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"coffeeshop:read", "timeline:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="time")
     * @Groups({"coffeeshop", "timeline"})
     */
    private DateTimeInterface $start;

    /**
     * @ORM\Column(type="time")
     * @Groups({"coffeeshop", "timeline"})
     */
    private DateTimeInterface $end;

    /**
     * @ORM\ManyToOne(targetEntity=Day::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"coffeeshop", "timeline"})
     */
    private ?Day $day;

    /**
     * @ORM\ManyToOne(targetEntity=Coffeeshop::class, inversedBy="timetable")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({"timeline"})
     */
    private ?Coffeeshop $coffeeshop;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(?Day $day): self
    {
        $this->day = $day;

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
}
