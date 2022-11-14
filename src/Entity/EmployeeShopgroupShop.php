<?php

namespace App\Entity;

use App\Repository\EmployeeShopgroupShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="employee_shopgroup_shop")
 * @ORM\Entity(repositoryClass=EmployeeShopgroupShopRepository::class)
 */
class EmployeeShopgroupShop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Employee::class, inversedBy="employeeShopgroupShops")
     */
    private $employee_id;

    /**
     * @ORM\ManyToMany(targetEntity=ShopGroup::class, inversedBy="employeeShopgroupShops")
     */
    private $shopgroup_id;

    /**
     * @ORM\ManyToMany(targetEntity=Shop::class, inversedBy="employeeShopgroupShops")
     */
    private $shop_id;

    public function __construct()
    {
        $this->employee_id = new ArrayCollection();
        $this->shopgroup_id = new ArrayCollection();
        $this->shop_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployeeId(): Collection
    {
        return $this->employee_id;
    }

    public function addEmployeeId(Employee $employeeId): self
    {
        if (!$this->employee_id->contains($employeeId)) {
            $this->employee_id[] = $employeeId;
        }

        return $this;
    }

    public function removeEmployeeId(Employee $employeeId): self
    {
        $this->employee_id->removeElement($employeeId);

        return $this;
    }

    /**
     * @return Collection<int, ShopGroup>
     */
    public function getShopgroupId(): Collection
    {
        return $this->shopgroup_id;
    }

    public function addShopgroupId(ShopGroup $shopgroupId): self
    {
        if (!$this->shopgroup_id->contains($shopgroupId)) {
            $this->shopgroup_id[] = $shopgroupId;
        }

        return $this;
    }

    public function removeShopgroupId(ShopGroup $shopgroupId): self
    {
        $this->shopgroup_id->removeElement($shopgroupId);

        return $this;
    }

    /**
     * @return Collection<int, Shop>
     */
    public function getShopId(): Collection
    {
        return $this->shop_id;
    }

    public function addShopId(Shop $shopId): self
    {
        if (!$this->shop_id->contains($shopId)) {
            $this->shop_id[] = $shopId;
        }

        return $this;
    }

    public function removeShopId(Shop $shopId): self
    {
        $this->shop_id->removeElement($shopId);

        return $this;
    }
}
