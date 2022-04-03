<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
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
     * @ORM\OneToOne(targetEntity=Image::class, mappedBy="fkcategory", cascade={"persist", "remove"})
     */
    private $fkimage;

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

    public function getFkimage(): ?Image
    {
        return $this->fkimage;
    }

    public function setFkimage(Image $fkimage): self
    {
        // set the owning side of the relation if necessary
        if ($fkimage->getFkcategory() !== $this) {
            $fkimage->setFkcategory($this);
        }

        $this->fkimage = $fkimage;

        return $this;
    }
}
