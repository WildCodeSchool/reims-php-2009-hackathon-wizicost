<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelRepository::class)
 */
class Model
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
    private string $NameBrand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $NameModel;

    /**
     * @ORM\ManyToOne(targetEntity=MachineType::class, inversedBy="models")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?MachineType $Machine;

    /**
     * @ORM\OneToMany(targetEntity=Option::class, mappedBy="Model")
     */
    private Collection $options;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="model")
     */
    private $resources;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->resources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBrand(): ?string
    {
        return $this->NameBrand;
    }

    public function setNameBrand(string $nameBrand): self
    {
        $this->NameBrand = $nameBrand;

        return $this;
    }

    public function getNameModel(): ?string
    {
        return $this->NameModel;
    }

    public function setNameModel(string $nameModel): self
    {
        $this->NameModel = $nameModel;

        return $this;
    }

    public function getMachine(): ?MachineType
    {
        return $this->Machine;
    }

    public function setMachine(?MachineType $machine): self
    {
        $this->Machine = $machine;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->setModel($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getModel() === $this) {
                $option->setModel(null);
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
            $resource->setModel($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getModel() === $this) {
                $resource->setModel(null);
            }
        }

        return $this;
    }
}
