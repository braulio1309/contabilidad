<?php

namespace App\Entity;

use App\Repository\VentaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sales")
 * @ORM\Entity(repositoryClass=VentaRepository::class)
 */
class Venta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="ventas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop_id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="ventas")
     */
    private $customer_id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tipo_identificacion;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $numero_identificacion;

    /**
     * @ORM\Column(type="text")
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_emision;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipo_documento;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $serie;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $secuencia;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $autorizacion_sri;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $clave_acceso;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $ambiente;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipo_emision;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_autorizacion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $xml;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $xml_estado;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mensaje_autorizacion;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $items;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $subtotal;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $descuento;

    /**
     * @ORM\Column(type="decimal",precision=8, scale=2, nullable=true)
     */
    private $id_tax;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $forma_pago;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $informacion_adicional;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $anulado;

    /**
     * @ORM\OneToMany(targetEntity=VentaTax::class, mappedBy="venta_id")
     */
    private $ventaTaxes;

    /**
     * @ORM\OneToMany(targetEntity=VentaDetail::class, mappedBy="venta_id", cascade={"persist"})
     */
    private $ventaDetails;

    public function __construct()
    {
        $this->ventaTaxes = new ArrayCollection();
        $this->ventaDetails = new ArrayCollection();
    }

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

    public function getCustomerId(): ?Customer
    {
        return $this->customer_id;
    }

    public function setCustomerId(?Customer $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    public function getTipoIdentificacion(): ?string
    {
        return $this->tipo_identificacion;
    }

    public function setTipoIdentificacion(?string $tipo_identificacion): self
    {
        $this->tipo_identificacion = $tipo_identificacion;

        return $this;
    }

    public function getNumeroIdentificacion(): ?string
    {
        return $this->numero_identificacion;
    }

    public function setNumeroIdentificacion(string $numero_identificacion): self
    {
        $this->numero_identificacion = $numero_identificacion;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFechaEmision(): ?\DateTimeInterface
    {
        return $this->fecha_emision;
    }

    public function setFechaEmision(\DateTimeInterface $fecha_emision): self
    {
        $this->fecha_emision = $fecha_emision;

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

    public function setSerie(?string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getSecuencia(): ?string
    {
        return $this->secuencia;
    }

    public function setSecuencia(?string $secuencia): self
    {
        $this->secuencia = $secuencia;

        return $this;
    }

    public function getAutorizacionSri(): ?string
    {
        return $this->autorizacion_sri;
    }

    public function setAutorizacionSri(?string $autorizacion_sri): self
    {
        $this->autorizacion_sri = $autorizacion_sri;

        return $this;
    }

    public function getClaveAcceso(): ?string
    {
        return $this->clave_acceso;
    }

    public function setClaveAcceso(string $clave_acceso): self
    {
        $this->clave_acceso = $clave_acceso;

        return $this;
    }

    public function getAmbiente(): ?string
    {
        return $this->ambiente;
    }

    public function setAmbiente(string $ambiente): self
    {
        $this->ambiente = $ambiente;

        return $this;
    }

    public function getTipoEmision(): ?string
    {
        return $this->tipo_emision;
    }

    public function setTipoEmision(string $tipo_emision): self
    {
        $this->tipo_emision = $tipo_emision;

        return $this;
    }

    public function getFechaAutorización(): ?\DateTimeInterface
    {
        return $this->fecha_autorización;
    }

    public function setFechaAutorizacion(?\DateTimeInterface $fecha_autorización): self
    {
        $this->fecha_autorización = $fecha_autorización;

        return $this;
    }

    public function getXml(): ?string
    {
        return $this->xml;
    }

    public function setXml(?string $xml): self
    {
        $this->xml = $xml;

        return $this;
    }

    public function getXmlEstado(): ?string
    {
        return $this->xml_estado;
    }

    public function setXmlEstado(?string $xml_estado): self
    {
        $this->xml_estado = $xml_estado;

        return $this;
    }

    public function getMensajeAutorizacion(): ?string
    {
        return $this->mensaje_autorizacion;
    }

    public function setMensajeAutorizacion(?string $mensaje_autorizacion): self
    {
        $this->mensaje_autorizacion = $mensaje_autorizacion;

        return $this;
    }

    public function getItems(): ?string
    {
        return $this->items;
    }

    public function setItems(string $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getSubtotal(): ?float
    {
        return $this->subtotal;
    }

    public function setSubtotal(?float $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getDescuento(): ?float
    {
        return $this->descuento;
    }

    public function setDescuento(?float $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getIdTax(): ?int
    {
        return $this->id_tax;
    }

    public function setIdTax($id_tax): self
    {
        $this->id_tax = $id_tax;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFormaPago(): ?string
    {
        return $this->forma_pago;
    }

    public function setFormaPago(?string $forma_pago): self
    {
        $this->forma_pago = $forma_pago;

        return $this;
    }

    public function getInformacionAdicional(): ?string
    {
        return $this->informacion_adicional;
    }

    public function setInformacionAdicional(?string $informacion_adicional): self
    {
        $this->informacion_adicional = $informacion_adicional;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isAnulado(): ?bool
    {
        return $this->anulado;
    }

    public function setAnulado(?bool $anulado): self
    {
        $this->anulado = $anulado;

        return $this;
    }

    /**
     * @return Collection<int, VentaTax>
     */
    public function getVentaTaxes(): Collection
    {
        return $this->ventaTaxes;
    }

    public function addVentaTax(VentaTax $ventaTax): self
    {
        if (!$this->ventaTaxes->contains($ventaTax)) {
            $this->ventaTaxes[] = $ventaTax;
            $ventaTax->setVentaId($this);
        }

        return $this;
    }

    public function removeVentaTax(VentaTax $ventaTax): self
    {
        if ($this->ventaTaxes->removeElement($ventaTax)) {
            // set the owning side to null (unless already changed)
            if ($ventaTax->getVentaId() === $this) {
                $ventaTax->setVentaId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VentaDetail>
     */
    public function getVentaDetails(): Collection
    {
        return $this->ventaDetails;
    }

    public function addVentaDetail(VentaDetail $ventaDetail): self
    {
        if (!$this->ventaDetails->contains($ventaDetail)) {
            $this->ventaDetails[] = $ventaDetail;
            $ventaDetail->setVentaId($this);
        }

        return $this;
    }

    public function removeVentaDetail(VentaDetail $ventaDetail): self
    {
        if ($this->ventaDetails->removeElement($ventaDetail)) {
            // set the owning side to null (unless already changed)
            if ($ventaDetail->getVentaId() === $this) {
                $ventaDetail->setVentaId(null);
            }
        }

        return $this;
    }
}
