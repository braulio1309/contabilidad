<?php

namespace App\Entity;

use App\Repository\VentaDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sales_details")
 * @ORM\Entity(repositoryClass=VentaDetailRepository::class)
 */
class VentaDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=Venta::class, inversedBy="ventaDetails")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $venta_id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $codigo_producto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $product_quantity;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $product_prie;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $product_subtotal;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $product_total;

    /**
     * @ORM\Column(type="decimal",precision=8, scale=2, nullable=true)
     */
    private $tax_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getVentaId(): ?Venta
    {
        return $this->venta_id;
    }

    public function setVentaId(?Venta $venta_id): self
    {
        $this->venta_id = $venta_id;

        return $this;
    }

    public function getCodigoProducto(): ?string
    {
        return $this->codigo_producto;
    }

    public function setCodigoProducto(string $codigo_producto): self
    {
        $this->codigo_producto = $codigo_producto;

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

    public function getProductQuantity(): ?string
    {
        return $this->product_quantity;
    }

    public function setProductQuantity(?string $product_quantity): self
    {
        $this->product_quantity = $product_quantity;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->product_prie;
    }

    public function setProductPrice(string $product_prie): self
    {
        $this->product_prie = $product_prie;

        return $this;
    }

    public function getProductSubtotal(): ?string
    {
        return $this->product_subtotal;
    }

    public function setProductSubtotal(?string $product_subtotal): self
    {
        $this->product_subtotal = $product_subtotal;

        return $this;
    }

    public function getProductTotal(): ?string
    {
        return $this->product_total;
    }

    public function setProductTotal(?string $product_total): self
    {
        $this->product_total = $product_total;

        return $this;
    }

    public function getTaxId(): ?int
    {
        return $this->tax_id;
    }

    public function setTaxId($tax_id): self
    {
        $this->tax_id = $tax_id;

        return $this;
    }
}
