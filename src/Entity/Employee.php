<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity=EmployeeShopgroupShop::class, mappedBy="employee_id")
     */
    private $employeeShopgroupShops;

    public function __construct()
    {
        $this->employeeShopgroupShops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
            $employeeShopgroupShop->addEmployeeId($this);
        }

        return $this;
    }

    public function removeEmployeeShopgroupShop(EmployeeShopgroupShop $employeeShopgroupShop): self
    {
        if ($this->employeeShopgroupShops->removeElement($employeeShopgroupShop)) {
            $employeeShopgroupShop->removeEmployeeId($this);
        }

        return $this;
    }
}
