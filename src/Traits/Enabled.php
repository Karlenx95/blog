<?php

namespace App\Traits;

trait Enabled
{

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEnabled;

    public function __construct()
    {
        $this->isEnabled = true;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }
}