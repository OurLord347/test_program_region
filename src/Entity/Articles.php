<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\PhotoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PhotoManagerRepository;
/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles extends AbstractController
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture_id;
    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted = 0;

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }
    public function setDeleted(?bool $deleted): self
    {
        $this->deleted = deleted;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getСategory(): ?string
    {
        return $this->category;
    }

    public function setСategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
    public function getPictureHref(PhotoManagerRepository $pmr): ?string
    {
        $pm = $pmr->find($this->picture_id);
        return $pm->getPhotoPath();
    }

    public function getPictureId(): ?string
    {
        return $this->picture_id;
    }

    public function setPictureId(string $picture_id): self
    {
        $this->picture_id = $picture_id;

        return $this;
    }
}
