<?php

namespace App\Entities;

use App\Interfaces\CharacterInterface;
use App\Database\DatabaseOperations;
use App\Models\CharacterModel;

class Character implements CharacterInterface
{
    public function __construct(DatabaseOperations $connection, string $name)
    {
        $this->connection = $connection;
        $this->model = new CharacterModel($connection, $name);
    }

    /**
     * Gets the character's name.
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->model->name;
    }

    /**
     * Gets the character's status to check if they are dead or alive.
     * 
     * @return bool
     */
    public function getAliveStatus(): bool
    {
        return $this->model->alive;
    }

    /**
     * Gets the character's longest streak of days survived.
     * 
     * @return int
     */
    public function getLongestStreak(): int
    {
        return $this->model->longest_streak;
    }
}