<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\Database\Database;
use App\Database\DatabaseOperations;

class DatabaseOperationsTest extends TestCase
{
    private $defaultTable = 'characters';
    private $defaultColumn = 'name';
    private $defaultColumnValue = '__this_is_a_tester__';
    private $defaultColumnValueAfterUpdate = '__updated_tester__';

    public function testCanInsertIntoDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $schema = [
            'alive' => true,
            'longest_streak' => 2
        ];
        $schema[$this->defaultColumn] = $this->defaultColumnValue;
        $this->assertTrue($connection->insert($this->defaultTable, $schema));
    }

    public function testCanGetAllFromColumn()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertIsArray(
            $connection->get(
                $this->defaultTable,
                $this->defaultColumn,
                $this->defaultColumnValue
            )
        );
    }

    public function testCanGetSpecificColumn()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertEquals(
            $this->defaultColumnValue, $connection->get(
                $this->defaultTable,
                $this->defaultColumn,
                $this->defaultColumnValue,
                $this->defaultColumn
            )
        );
    }

    public function testCanUpdateInDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertTrue(
            $connection->update(
                $this->defaultTable,
                $this->defaultColumn,
                $this->defaultColumnValue,
                $this->defaultColumn,
                $this->defaultColumnValueAfterUpdate
            )
        );

        $actualValue = $connection->get(
            $this->defaultTable,
            $this->defaultColumn,
            $this->defaultColumnValueAfterUpdate,
            $this->defaultColumn
        );

        $this->assertEquals($this->defaultColumnValueAfterUpdate, $actualValue);
    }

    public function testCanDeleteFromDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertTrue(
            $connection->delete(
                $this->defaultTable,
                $this->defaultColumn,
                $this->defaultColumnValueAfterUpdate
            )
        );
    }
}