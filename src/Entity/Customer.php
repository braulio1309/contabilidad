<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="ps_customer")
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @UniqueEntity(fields={"numero_identificacion"}, message="Este número de identificación ya está en uso.")
 * @UniqueEntity(fields={"email"}, message="Este email ya está en uso.")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_customer",type="integer")
     */
    private $id;

    /**
     * @ORM\Column( type="string", length=30, nullable=true)
     * @Assert\NotBlank
     * @Assert\Choice({"04", "05", "06","07"})
     */
    private $tipo_identificacion;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank
     */
    private $numero_identificacion;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Assert\NotBlank
     */
    private $phone;

    /**
     * @ORM\Column(name="ciudad",type="string", length=60, nullable=true)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Venta::class, mappedBy="customer_id")
     */
    private $ventas;

    public function __construct()
    {
        $this->ventas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1($address1): self
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

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
            $venta->setCustomerId($this);
        }

        return $this;
    }

    public function removeVenta(Venta $venta): self
    {
        if ($this->ventas->removeElement($venta)) {
            // set the owning side to null (unless already changed)
            if ($venta->getCustomerId() === $this) {
                $venta->setCustomerId(null);
            }
        }

        return $this;
    }
}
