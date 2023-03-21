<?php

namespace App\Entity;

use App\Repository\ShopSerieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Table(name="sp_shop_series")
 * @ORM\Entity(repositoryClass=ShopSerieRepository::class)
 * @UniqueEntity(fields={"nombre_comercial"}, message="Este nombre de ya está en uso.")
 */
class ShopSerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_shop_series",type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="shopSeries")
     * @ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop")
     */
    private $shop_id;

    // /**
    //  * @ORM\Column(type="string", length=2)
    //  */
    // private $tipo_documento;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $serie;
    
    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\Choice({"01", "03","04","05","06","07"})
     */
    private $codigo_documento;

    /**
     * @ORM\Column(type="string", length=9)
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
    private $active = 1;

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

    // public function getTipoDocumento(): ?string
    // {
    //     return $this->tipo_documento;
    // }

    // public function setTipoDocumento(string $tipo_documento): self
    // {
    //     $this->tipo_documento = $tipo_documento;

    //     return $this;
    // }
    
    public function getCodigoDocumento(): ?string
    {
        return $this->codigo_documento;
    }

    public function setCodigoDocumento(string $codigo_documento): self
    {
        $this->codigo_documento = $codigo_documento;

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
