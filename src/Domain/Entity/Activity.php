<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Activity
{
    private string $name;
    private int $difficulty;
    private int $position;
    private string $identifier;
    private int $time;
    private string $solution;

    public function __construct(
        string $name,
        int $difficulty,
        int $position,
        string $identifier,
        int $time,
        string $solution
    ) {
        $this->name = $name;
        $this->difficulty = $difficulty;
        $this->position = $position;
        $this->identifier = $identifier;
        $this->time = $time;
        $this->solution = $solution;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function solution(): string
    {
        return $this->solution;
    }
}
