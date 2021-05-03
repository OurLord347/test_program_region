<?php

namespace App\Entity;

use App\Repository\PhotoManagerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoManagerRepository::class)
 */
class PhotoManager
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
    private $photo_path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoPath(): ?string
    {
        return $this->photo_path;
    }

    public function setPhotoPath(string $photo_path): self
    {
        $this->photo_path = $photo_path;

        return $this;
    }

    public function getPhotoName(): ?string
    {
        return $this->photo_name;
    }

    public function setPhotoName(string $photo_name): self
    {
        $this->photo_name = $photo_name;

        return $this;
    }
}
