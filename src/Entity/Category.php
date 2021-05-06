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
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Artical::class, mappedBy="category")
     */
    private $articals;

    public function __construct()
    {
        $this->articals = new ArrayCollection();
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
     * @return Collection|Artical[]
     */
    public function getArticals(): Collection
    {
        return $this->articals;
    }

    public function addArtical(Artical $artical): self
    {
        if (!$this->articals->contains($artical)) {
            $this->articals[] = $artical;
            $artical->setCategory($this);
        }

        return $this;
    }

    public function removeArtical(Artical $artical): self
    {
        if ($this->articals->removeElement($artical)) {
            // set the owning side to null (unless already changed)
            if ($artical->getCategory() === $this) {
                $artical->setCategory(null);
            }
        }

        return $this;
    }
        public function __toString()
        {
            return $this->id ? $this ->getName():'New Category';
            // TODO: Implement __toString() method.
        }
}
