<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee implements
UserInterface,
PasswordAuthenticatedUserInterface,
PasswordHasherAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es valido."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = 1;

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

    public function getPasswordHasherName(): ?string
    {
        return null; // use the default hasher
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
