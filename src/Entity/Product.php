<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tag;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\OneToMany(targetEntity=Attachement::class, mappedBy="fkproduct", cascade={"persist","remove"})
     */
    private $attachements;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstimage;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="fkproduct")
     */
    private $fkcategory;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="firstimage")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isNewArrival = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isBest = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHot = false;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shoesize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $branding;

    public function __construct()
    {
        $this->attachements = new ArrayCollection();
        $this->fkcategory = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable('now');
        $this->shoesizes = new ArrayCollection();
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

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    /**
     * @return Collection<int, Attachement>
     */
    public function getAttachements(): Collection
    {
        return $this->attachements;
    }

    public function addAttachement(Attachement $attachement): self
    {
        if (!$this->attachements->contains($attachement)) {
            $this->attachements[] = $attachement;
            $attachement->setFkproduct($this);
        }

        return $this;
    }

    public function removeAttachement(Attachement $attachement): self
    {
        if ($this->attachements->removeElement($attachement)) {
            // set the owning side to null (unless already changed)
            if ($attachement->getFkproduct() === $this) {
                $attachement->setFkproduct(null);
            }
        }

        return $this;
    }

    public function getFirstimage(): ?string
    {
        return $this->firstimage;
    }

    public function setFirstimage(?string $firstimage): self
    {
        $this->firstimage = $firstimage;

        return $this;
    }

    public function setImageFile(File $firstimage = null)
    {
        $this->imageFile = $firstimage;

        if ($firstimage) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getFkcategory(): Collection
    {
        return $this->fkcategory;
    }

    public function addFkcategory(Category $fkcategory): self
    {
        if (!$this->fkcategory->contains($fkcategory)) {
            $this->fkcategory[] = $fkcategory;
        }

        return $this;
    }

    public function removeFkcategory(Category $fkcategory): self
    {
        $this->fkcategory->removeElement($fkcategory);

        return $this;
    }

    public function getIsNewArrival(): ?bool
    {
        return $this->isNewArrival;
    }

    public function setIsNewArrival(?bool $isNewArrival): self
    {
        $this->isNewArrival = $isNewArrival;

        return $this;
    }

    public function getIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(?bool $isBest): self
    {
        $this->isBest = $isBest;

        return $this;
    }

    public function getIsHot(): ?bool
    {
        return $this->isHot;
    }

    public function setIsHot(bool $isHot): self
    {
        $this->isHot = $isHot;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getShoesize(): ?int
    {
        return $this->shoesize;
    }

    public function setShoesize(?int $shoesize): self
    {
        $this->shoesize = $shoesize;

        return $this;
    }

    public function getBranding(): ?string
    {
        return $this->branding;
    }

    public function setBranding(?string $branding): self
    {
        $this->branding = $branding;

        return $this;
    }
  
}
