<?php

namespace App\Entity;

use App\Repository\VentaDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sp_ventas_detail")
 * @ORM\Entity(repositoryClass=VentaDetailRepository::class)
 */
class VentaDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_venta_detail",type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
    * @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     */
    private $id_product;

    /**
     * @ORM\ManyToOne(targetEntity=Venta::class, inversedBy="ventaDetails")
     * @ORM\JoinColumn(name="id_venta", referencedColumnName="id_venta")
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
    private $product_price;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $product_subtotal;
    
    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $product_descuento;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $product_total;

    /**
     * @ORM\Column(type="decimal",precision=8, scale=2, nullable=true)
     */
    private $id_tax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?Product
    {
        return $this->id_product;
    }

    public function setProductId(?Product $id_product): self
    {
        $this->id_product = $id_product;

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
        return $this->product_price;
    }

    public function setProductPrice(string $product_price): self
    {
        $this->product_price = $product_price;

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
    
    public function getProductDescuento(): ?string
    {
        return $this->product_descuento;
    }

    public function setProductDescuento(?string $product_descuento): self
    {
        $this->product_descuento = $product_descuento;

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
        return $this->id_tax;
    }

    public function setTaxId($id_tax): self
    {
        $this->id_tax = $id_tax;

        return $this;
    }
}
