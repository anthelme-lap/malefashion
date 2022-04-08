<?php

namespace App\Entity;

use App\Repository\AttachementRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttachementRepository::class)
 * @Vich\Uploadable
 */
class Attachement
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
    private $images;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="attachements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkproduct;

    /**
     * @Vich\UploadableField(mapping="attachement", fileNameProperty="images")
     * @var File
     */
    private $imageFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

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

    public function setImageFile(File $images = null)
    {
        $this->imageFile = $images;

        if ($images) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
