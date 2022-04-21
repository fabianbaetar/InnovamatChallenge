<?php

declare(strict_types=1);

namespace App\Entity;

class Activity
{
    public $name;
    public $difficulty;
    public $position;
    public $identifier;
    public $time;
    public $solution;

    public function __construct($name, $difficulty, $position, $identifier, $time, $solution)
    {
        $this->name = $name;
        $this->difficulty = $difficulty;
        $this->position = $position;
        $this->identifier = $identifier;
        $this->time = $time;
        $this->solution = $solution;
    }

    public function name()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setDifficulty($difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position): void
    {
        $this->position = $position;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setIdentifier($identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time): void
    {
        $this->time = $time;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    public function setSolution($solution): void
    {
        $this->solution = $solution;
    }
}
