<?php

namespace App\Entity;

use App\Repository\TaxesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="taxes")
 * @ORM\Entity(repositoryClass=TaxesRepository::class)
 */
class Taxes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
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
}
