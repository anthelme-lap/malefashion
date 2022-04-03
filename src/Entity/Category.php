<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @Vich\Uploadable
 */
class Category
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
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagecategory;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="fkcategory")
     */
    private $fkproduct;

    /**
     * @Vich\UploadableField(mapping="category_image", fileNameProperty="imagecategory")
     * @var File
     */
    private $imageFile;

    public function __construct()
    {
        $this->fkproduct = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getImagecategory(): ?string
    {
        return $this->imagecategory;
    }

    public function setImagecategory(string $imagecategory): self
    {
        $this->imagecategory = $imagecategory;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getFkproduct(): Collection
    {
        return $this->fkproduct;
    }

    public function addFkproduct(Product $fkproduct): self
    {
        if (!$this->fkproduct->contains($fkproduct)) {
            $this->fkproduct[] = $fkproduct;
            $fkproduct->addFkcategory($this);
        }

        return $this;
    }

    public function removeFkproduct(Product $fkproduct): self
    {
        if ($this->fkproduct->removeElement($fkproduct)) {
            $fkproduct->removeFkcategory($this);
        }

        return $this;
    }


    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function __toString()
    {
        return $this->name;
    }
}
