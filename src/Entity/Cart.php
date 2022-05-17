<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 * @ORM\Table(name="`Cart`")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressdelivery;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $moreinformation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid = false;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Carts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkuser;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $subTotal;

    /**
     * @ORM\OneToMany(targetEntity=CartDetail::class, mappedBy="Carts")
     */
    private $CartDetail;

    public function __construct()
    {
        $this->CartDetail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getAdressdelivery(): ?string
    {
        return $this->adressdelivery;
    }

    public function setAdressdelivery(string $adressdelivery): self
    {
        $this->adressdelivery = $adressdelivery;

        return $this;
    }

    public function getMoreinformation(): ?string
    {
        return $this->moreinformation;
    }

    public function setMoreinformation(?string $moreinformation): self
    {
        $this->moreinformation = $moreinformation;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFkuser(): ?User
    {
        return $this->fkuser;
    }

    public function setFkuser(?User $fkuser): self
    {
        $this->fkuser = $fkuser;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSubTotal(): ?float
    {
        return $this->subTotal;
    }

    public function setSubTotal(float $subTotal): self
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * @return Collection<int, CartDetail>
     */
    public function getCartDetail(): Collection
    {
        return $this->CartDetail;
    }

    public function addCartDetail(CartDetail $CartDetail): self
    {
        if (!$this->CartDetail->contains($CartDetail)) {
            $this->CartDetail[] = $CartDetail;
            $CartDetail->setCarts($this);
        }

        return $this;
    }

    public function removeCartDetail(CartDetail $CartDetail): self
    {
        if ($this->CartDetail->removeElement($CartDetail)) {
            // set the owning side to null (unless already changed)
            if ($CartDetail->getCarts() === $this) {
                $CartDetail->setCarts(null);
            }
        }

        return $this;
    }
}
