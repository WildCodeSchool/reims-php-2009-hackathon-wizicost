<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=MachineType::class, mappedBy="Category")
     */
    private Collection $machineTypes;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="category")
     */
    private $resources;

    public function __construct()
    {
        $this->machineTypes = new ArrayCollection();
        $this->resources = new ArrayCollection();
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
     * @return Collection|MachineType[]
     */
    public function getMachineTypes(): Collection
    {
        return $this->machineTypes;
    }

    public function addMachineType(MachineType $machineType): self
    {
        if (!$this->machineTypes->contains($machineType)) {
            $this->machineTypes[] = $machineType;
            $machineType->setCategory($this);
        }

        return $this;
    }

    public function removeMachineType(MachineType $machineType): self
    {
        if ($this->machineTypes->removeElement($machineType)) {
            // set the owning side to null (unless already changed)
            if ($machineType->getCategory() === $this) {
                $machineType->setCategory(null);
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
            $resource->setCategory($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getCategory() === $this) {
                $resource->setCategory(null);
            }
        }

        return $this;
    }
}
