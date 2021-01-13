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
}
