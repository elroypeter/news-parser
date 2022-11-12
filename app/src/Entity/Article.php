<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    public function __construct($title, $short_description, $picture, $date_added){
        $this->title = $title;
        $this->picture = $picture;
        $this->date_added = $date_added;
        $this->short_description = $short_description;
    }
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $short_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_added;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_updated;

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

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDateAdded(): ?string
    {
        return $this->date_added;
    }

    public function setDateAdded(string $date_added): self
    {
        $this->date_added = $date_added;

        return $this;
    }

    public function getLastUpdated(): ?string
    {
        return $this->last_updated;
    }

    public function setLastUpdated(?string $last_updated): self
    {
        $this->last_updated = $last_updated;

        return $this;
    }
}
