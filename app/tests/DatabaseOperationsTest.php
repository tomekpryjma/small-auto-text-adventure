<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\Database\Database;
use App\Database\DatabaseOperations;

class DatabaseOperationsTest extends TestCase
{
    public function testCanInsertIntoDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertTrue($connection->insertInto(
            'characters',
            [
                'name' => 'Tester',
                'alive' => true,
                'longest_streak' => 2
            ]
        ));
    }

    public function testCanDeleteFromDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertTrue($connection->deleteFrom(
            'characters',
            'name',
            'Tester'
        ));
    }
}