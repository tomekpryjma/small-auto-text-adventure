<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\Entities\Character;
use App\Database\Database;
use App\Database\DatabaseOperations;

final class CharactersTest extends TestCase
{
    private $_name = '__davey_the_tester__';

    /**
     * Test to determine whether the character's name can
     * be retrieved.
     * 
     * @return void
     */
    public function testCanGetCharacterName()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $character = new Character($connection, $this->_name);
        $this->assertEquals($this->_name, $character->getName());
    }
}