<?php

namespace App\Entity;

use App\Repository\ShopSerieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopSerieRepository::class)
 */
class ShopSerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="shopSeries")
     */
    private $shop_id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $tipo_documento;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $serie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secuencia;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nombre_comercial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direccion_establecimiento;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShopId(): ?Shop
    {
        return $this->shop_id;
    }

    public function setShopId(?Shop $shop_id): self
    {
        $this->shop_id = $shop_id;

        return $this;
    }

    public function getTipoDocumento(): ?string
    {
        return $this->tipo_documento;
    }

    public function setTipoDocumento(string $tipo_documento): self
    {
        $this->tipo_documento = $tipo_documento;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getSecuencia(): ?string
    {
        return $this->secuencia;
    }

    public function setSecuencia(string $secuencia): self
    {
        $this->secuencia = $secuencia;

        return $this;
    }

    public function getNombreComercial(): ?string
    {
        return $this->nombre_comercial;
    }

    public function setNombreComercial(string $nombre_comercial): self
    {
        $this->nombre_comercial = $nombre_comercial;

        return $this;
    }

    public function getDireccionEstablecimiento(): ?string
    {
        return $this->direccion_establecimiento;
    }

    public function setDireccionEstablecimiento(string $direccion_establecimiento): self
    {
        $this->direccion_establecimiento = $direccion_establecimiento;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
