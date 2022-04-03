<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
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
    private $imagename;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="fkimage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkproduct;

    /**
     * @ORM\OneToOne(targetEntity=Category::class, inversedBy="fkimage", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkcategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagename(): ?string
    {
        return $this->imagename;
    }

    public function setImagename(string $imagename): self
    {
        $this->imagename = $imagename;

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

    public function getFkproduct(): ?Product
    {
        return $this->fkproduct;
    }

    public function setFkproduct(?Product $fkproduct): self
    {
        $this->fkproduct = $fkproduct;

        return $this;
    }

    public function getFkcategory(): ?Category
    {
        return $this->fkcategory;
    }

    public function setFkcategory(Category $fkcategory): self
    {
        $this->fkcategory = $fkcategory;

        return $this;
    }
}
