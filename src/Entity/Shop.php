<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="shops")
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
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
     * @ORM\Column(type="string", length=13)
     */
    private $numero_identificacion;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $direccion_matriz;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $regimen_rimpe;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $agente_retencion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $obligado_contabilidad;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $contribuyente_especial;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity=Venta::class, mappedBy="shop_id")
     */
    private $ventas;

    /**
     * @ORM\ManyToMany(targetEntity=EmployeeShopgroupShop::class, mappedBy="shop_id")
     */
    private $employeeShopgroupShops;

    public function __construct()
    {
        $this->ventas = new ArrayCollection();
        $this->employeeShopgroupShops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDireccionMatriz(): ?string
    {
        return $this->direccion_matriz;
    }

    public function setDireccionMatriz(string $direccion_matriz): self
    {
        $this->direccion_matriz = $direccion_matriz;

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

    public function isRegimenRimpe(): ?bool
    {
        return $this->regimen_rimpe;
    }

    public function setRegimenRimpe(bool $regimen_rimpe): self
    {
        $this->regimen_rimpe = $regimen_rimpe;

        return $this;
    }

    public function getAgenteRetencion(): ?string
    {
        return $this->agente_retencion;
    }

    public function setAgenteRetencion(string $agente_retencion): self
    {
        $this->agente_retencion = $agente_retencion;

        return $this;
    }

    public function isObligadoContabilidad(): ?bool
    {
        return $this->obligado_contabilidad;
    }

    public function setObligadoContabilidad(bool $obligado_contabilidad): self
    {
        $this->obligado_contabilidad = $obligado_contabilidad;

        return $this;
    }

    public function getContribuyenteEspecial(): ?string
    {
        return $this->contribuyente_especial;
    }

    public function setContribuyenteEspecial(string $contribuyente_especial): self
    {
        $this->contribuyente_especial = $contribuyente_especial;

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

    /**
     * @return Collection<int, Venta>
     */
    public function getVentas(): Collection
    {
        return $this->ventas;
    }

    public function addVenta(Venta $venta): self
    {
        if (!$this->ventas->contains($venta)) {
            $this->ventas[] = $venta;
            $venta->setShopId($this);
        }

        return $this;
    }

    public function removeVenta(Venta $venta): self
    {
        if ($this->ventas->removeElement($venta)) {
            // set the owning side to null (unless already changed)
            if ($venta->getShopId() === $this) {
                $venta->setShopId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EmployeeShopgroupShop>
     */
    public function getEmployeeShopgroupShops(): Collection
    {
        return $this->employeeShopgroupShops;
    }

    public function addEmployeeShopgroupShop(EmployeeShopgroupShop $employeeShopgroupShop): self
    {
        if (!$this->employeeShopgroupShops->contains($employeeShopgroupShop)) {
            $this->employeeShopgroupShops[] = $employeeShopgroupShop;
            $employeeShopgroupShop->addShopId($this);
        }

        return $this;
    }

    public function removeEmployeeShopgroupShop(EmployeeShopgroupShop $employeeShopgroupShop): self
    {
        if ($this->employeeShopgroupShops->removeElement($employeeShopgroupShop)) {
            $employeeShopgroupShop->removeShopId($this);
        }

        return $this;
    }
}
