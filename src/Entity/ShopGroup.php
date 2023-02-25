<?php

namespace App\Entity;

use App\Repository\ShopGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="sp_shopgroup")
 * @ORM\Entity(repositoryClass=ShopGroupRepository::class)
 */
class ShopGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_shopgroup",type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=EmployeeShopgroupShop::class, mappedBy="shopgroup_id")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $employeeShopgroupShop->addShopgroupId($this);
        }

        return $this;
    }

    public function removeEmployeeShopgroupShop(EmployeeShopgroupShop $employeeShopgroupShop): self
    {
        if ($this->employeeShopgroupShops->removeElement($employeeShopgroupShop)) {
            $employeeShopgroupShop->removeShopgroupId($this);
        }

        return $this;
    }
}
