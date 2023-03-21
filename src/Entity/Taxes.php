<?php

namespace App\Entity;

use App\Repository\TaxesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sp_taxes")
 * @ORM\Entity(repositoryClass=TaxesRepository::class)
 */
class Taxes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_tax",type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nombre_impuesto;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $porcentaje;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="tax")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreImpuesto(): ?string
    {
        return $this->nombre_impuesto;
    }

    public function setNombreImpuesto(string $nombre_impuesto): self
    {
        $this->nombre_impuesto = $nombre_impuesto;

        return $this;
    }

    public function getPorcentaje(): ?string
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(string $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setTax($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getTax() === $this) {
                $product->setTax(null);
            }
        }

        return $this;
    }
}
