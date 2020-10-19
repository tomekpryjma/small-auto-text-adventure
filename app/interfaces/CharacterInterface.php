<?php

namespace App\Interfaces;

interface CharacterInterface
{
    /**
     * Gets the character's name.
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Gets the characters alive status.
     */
    public function getAliveStatus(): bool;

    /**
     * Gets the character's longest streak for being alive.
     */
    public function getLongestStreak(): int;
}