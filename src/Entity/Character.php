<?php

namespace App\Entity;

class Character
{
    /** @var int|null */
    protected ?int $id = NULL;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return Character
     */
    public function setId(?int $id): Character
    {
        $this->id = $id;
        return $this;
    }
}
