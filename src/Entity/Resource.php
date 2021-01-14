<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResourceRepository::class)
 */
class Resource
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="resources")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=MachineType::class, inversedBy="resources")
     */
    private $machineType;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="resources")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Option::class, inversedBy="resources")
     */
    private $optional;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="resources")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $cost;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="resources")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $residualvalue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $worktime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getMachineType(): ?MachineType
    {
        return $this->machineType;
    }

    public function setMachineType(?MachineType $machineType): self
    {
        $this->machineType = $machineType;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getOptional(): ?Option
    {
        return $this->optional;
    }

    public function setOptional(?Option $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(?int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getResidualvalue(): ?string
    {
        return $this->residualvalue;
    }

    public function setResidualvalue(?string $residualvalue): self
    {
        $this->residualvalue = $residualvalue;

        return $this;
    }

    public function getWorktime(): ?int
    {
        return $this->worktime;
    }

    public function setWorktime(?int $worktime): self
    {
        $this->worktime = $worktime;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;

        return $this;
    }
}
