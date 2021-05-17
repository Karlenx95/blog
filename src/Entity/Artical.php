<?php

namespace App\Entity;

use App\Repository\ArticalRepository;
use App\Traits\Enabled;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticalRepository::class)
 */
class Artical
{
    use Enabled;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=3)
     * @Assert\Regex(
     *     pattern="/\d/"
     * )
     */
    private $name;

    /**
     * @Assert\NotNull()
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Description must be at least {{ limit }} characters long",
     *      maxMessage = "Description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $articalType;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articals",cascade={"persist","remove"})
     */
    private $category;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
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




    public function getPage($page = 1)
    {
        if ($page < 1) {
            $page = 1;
        }

        return floor($page);
    }

    public function getLimit($limit = 20)
    {
        if ($limit < 1 || $limit > 20) {
            $limit = 20;
        }

        return floor($limit);
    }

    public function getOffset($page, $limit)
    {
        $offset = 0;
        if ($page != 0 && $page != 1) {
            $offset = ($page - 1) * $limit;
        }

        return $offset;
    }
}
