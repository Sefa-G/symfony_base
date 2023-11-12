<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'burgers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bread $bread = null;

    #[ORM\ManyToMany(targetEntity: Onion::class, inversedBy: 'burgers')]
    private Collection $onion;

    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burgers')]
    private Collection $sauce;

    #[ORM\OneToOne(inversedBy: 'burger', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: Review::class)]
    private Collection $review;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    public function __construct()
    {
        $this->onion = new ArrayCollection();
        $this->sauce = new ArrayCollection();
        $this->review = new ArrayCollection();
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

    public function getBread(): ?Bread
    {
        return $this->bread;
    }

    public function setBread(?Bread $bread): static
    {
        $this->bread = $bread;

        return $this;
    }

    /**
     * @return Collection<int, Onion>
     */
    public function getOnion(): Collection
    {
        return $this->onion;
    }

    public function addOnion(Onion $onion): static
    {
        if (!$this->onion->contains($onion)) {
            $this->onion->add($onion);
        }

        return $this;
    }

    public function removeOnion(Onion $onion): static
    {
        $this->onion->removeElement($onion);

        return $this;
    }

    /**
     * @return Collection<int, Sauce>
     */
    public function getSauce(): Collection
    {
        return $this->sauce;
    }

    public function addSauce(Sauce $sauce): static
    {
        if (!$this->sauce->contains($sauce)) {
            $this->sauce->add($sauce);
        }

        return $this;
    }

    public function removeSauce(Sauce $sauce): static
    {
        $this->sauce->removeElement($sauce);

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReview(): Collection
    {
        return $this->review;
    }

    public function addReview(Review $review): static
    {
        if (!$this->review->contains($review)) {
            $this->review->add($review);
            $review->setBurger($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->review->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getBurger() === $this) {
                $review->setBurger(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
}
