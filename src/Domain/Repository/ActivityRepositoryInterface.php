<?php

declare(strict_types=1);

namespace App\Domain\Repository;

interface ActivityRepositoryInterface
{
    public function getAllActivities(): array;

    public function addActivity(
        int $identifier,
        string $name,
        int $position,
        int $time,
        int $difficulty,
        string $solution
    ): bool;
}