<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\Column(type="json")
     */
    private $logoIds = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ColorsGroup", mappedBy="project")
     */
    private $colorsGroups;

    public function __construct()
    {
        $this->colorsGroups = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLogoIds(): ?array
    {
        return $this->logoIds;
    }

    public function setLogoIds(array $logoIds): self
    {
        $this->logoIds = $logoIds;

        return $this;
    }

    /**
     * @return Collection|ColorsGroup[]
     */
    public function getColorsGroups(): Collection
    {
        return $this->colorsGroups;
    }

    public function addColorsGroup(ColorsGroup $colorsGroup): self
    {
        if (!$this->colorsGroups->contains($colorsGroup)) {
            $this->colorsGroups[] = $colorsGroup;
            $colorsGroup->setProject($this);
        }

        return $this;
    }

    public function removeColorsGroup(ColorsGroup $colorsGroup): self
    {
        if ($this->colorsGroups->contains($colorsGroup)) {
            $this->colorsGroups->removeElement($colorsGroup);
            // set the owning side to null (unless already changed)
            if ($colorsGroup->getProject() === $this) {
                $colorsGroup->setProject(null);
            }
        }

        return $this;
    }
}
