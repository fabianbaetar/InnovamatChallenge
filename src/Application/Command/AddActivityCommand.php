<?php

declare(strict_types=1);

namespace App\Application\Command;

class AddActivityCommand
{
    private int $identifier;
    private string $name;
    private int $position;
    private int $time;
    private int $difficulty;
    private string $solution;

    public function __construct(
        int $identifier,
        string $name,
        int $position,
        int $time,
        int $difficulty,
        string $solution
    ) {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->position = $position;
        $this->time = $time;
        $this->difficulty = $difficulty;
        $this->solution = $solution;
    }

    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    public function getSolution(): string
    {
        return $this->solution;
    }
}
