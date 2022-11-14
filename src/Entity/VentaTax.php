<?php

namespace App\Entity;

use App\Repository\VentaTaxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sales_taxes")
 * @ORM\Entity(repositoryClass=VentaTaxRepository::class)
 */
class VentaTax
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Venta::class, inversedBy="ventaTaxes")
     */
    private $venta_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $tax_id;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $porcentaje;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $base_imponible;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $valor_impuesto;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTaxId(): ?int
    {
        return $this->tax_id;
    }

    public function setTaxId(int $tax_id): self
    {
        $this->tax_id = $tax_id;

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

    public function getBaseImponible(): ?string
    {
        return $this->base_imponible;
    }

    public function setBaseImponible(string $base_imponible): self
    {
        $this->base_imponible = $base_imponible;

        return $this;
    }

    public function getValorImpuesto(): ?string
    {
        return $this->valor_impuesto;
    }

    public function setValorImpuesto(string $valor_impuesto): self
    {
        $this->valor_impuesto = $valor_impuesto;

        return $this;
    }
}
