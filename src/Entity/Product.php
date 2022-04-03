<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tag;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $moredescription;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dresssize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shoesize;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="fkproduct")
     */
    private $fkimage;

    public function __construct()
    {
        $this->fkimage = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

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

    public function getMoredescription(): ?string
    {
        return $this->moredescription;
    }

    public function setMoredescription(?string $moredescription): self
    {
        $this->moredescription = $moredescription;

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

    public function getDresssize(): ?string
    {
        return $this->dresssize;
    }

    public function setDresssize(?string $dresssize): self
    {
        $this->dresssize = $dresssize;

        return $this;
    }

    public function getShoesize(): ?string
    {
        return $this->shoesize;
    }

    public function setShoesize(?string $shoesize): self
    {
        $this->shoesize = $shoesize;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getFkimage(): Collection
    {
        return $this->fkimage;
    }

    public function addFkimage(Image $fkimage): self
    {
        if (!$this->fkimage->contains($fkimage)) {
            $this->fkimage[] = $fkimage;
            $fkimage->setFkproduct($this);
        }

        return $this;
    }

    public function removeFkimage(Image $fkimage): self
    {
        if ($this->fkimage->removeElement($fkimage)) {
            // set the owning side to null (unless already changed)
            if ($fkimage->getFkproduct() === $this) {
                $fkimage->setFkproduct(null);
            }
        }

        return $this;
    }
}
