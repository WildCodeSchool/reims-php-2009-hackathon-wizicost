<?php

namespace App\Entity;

use App\Repository\MachineTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineTypeRepository::class)
 */
class MachineType
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
    private string $Type;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="machineTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Category $Category;

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="Machine")
     */
    private Collection $models;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="machineType")
     */
    private $resources;

    public function __construct()
    {
        $this->models = new ArrayCollection();
        $this->resources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $type): self
    {
        $this->Type = $type;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $category): self
    {
        $this->Category = $category;

        return $this;
    }

    /**
     * @return Collection|Model[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
            $model->setMachine($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getMachine() === $this) {
                $model->setMachine(null);
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
            $resource->setMachineType($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getMachineType() === $this) {
                $resource->setMachineType(null);
            }
        }

        return $this;
    }
}
