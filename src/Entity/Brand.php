<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $brand;

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="brand")
     */
    private $model;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="brand")
     */
    private $resources;

    /**
     * @ORM\ManyToMany(targetEntity=MachineType::class, inversedBy="brands")
     */
    private $machineType;

    public function __construct()
    {
        $this->model = new ArrayCollection();
        $this->resources = new ArrayCollection();
        $this->machineType = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Model[]
     */
    public function getModel(): Collection
    {
        return $this->model;
    }

    public function addModel(Model $model): self
    {
        if (!$this->model->contains($model)) {
            $this->model[] = $model;
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->model->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Resource[]
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resource $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources[] = $resource;
            $resource->setBrand($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getBrand() === $this) {
                $resource->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MachineType[]
     */
    public function getMachineType(): Collection
    {
        return $this->machineType;
    }

    public function addMachineType(MachineType $machineType): self
    {
        if (!$this->machineType->contains($machineType)) {
            $this->machineType[] = $machineType;
        }

        return $this;
    }

    public function removeMachineType(MachineType $machineType): self
    {
        $this->machineType->removeElement($machineType);

        return $this;
    }

    public function __toString()
{
    return (string) $this->getBrand();
}
}
