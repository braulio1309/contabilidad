<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products")
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description_aditional1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description_aditional2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description_aditional3;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getY(): ?string
    {
        return $this->y;
    }

    public function setY(string $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getDescriptionAditional1(): ?string
    {
        return $this->description_aditional1;
    }

    public function setDescriptionAditional1(?string $description_aditional1): self
    {
        $this->description_aditional1 = $description_aditional1;

        return $this;
    }

    public function getDescriptionAditional2(): ?string
    {
        return $this->description_aditional2;
    }

    public function setDescriptionAditional2(?string $description_aditional2): self
    {
        $this->description_aditional2 = $description_aditional2;

        return $this;
    }

    public function getDescriptionAditional3(): ?string
    {
        return $this->description_aditional3;
    }

    public function setDescriptionAditional3(?string $description_aditional3): self
    {
        $this->description_aditional3 = $description_aditional3;

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
}
