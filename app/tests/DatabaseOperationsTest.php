<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\Database\Database;
use App\Database\DatabaseOperations;

class DatabaseOperationsTest extends TestCase
{
    private $_defaultTable = 'characters';
    private $_defaultColumn = 'name';
    private $_defaultColumnValue = '__this_is_a_tester__';
    private $_defaultColumnValueAfterUpdate = '__updated_tester__';

    /**
     * Test to determine whether the program can insert a row into
     * the specified table.
     * 
     * @return void
     */
    public function testCanInsertIntoDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $schema = [
            'alive' => true,
            'longest_streak' => 2
        ];
        $schema[$this->_defaultColumn] = $this->_defaultColumnValue;
        $this->assertTrue($connection->insert($this->_defaultTable, $schema));
    }

    /**
     * Test to determine whether the program can get all columns of
     * a row from a specified table.
     * 
     * @return void
     */
    public function testCanGetAllFromRow()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertIsArray(
            $connection->get(
                $this->_defaultTable,
                $this->_defaultColumn,
                $this->_defaultColumnValue
            )
        );
    }

    /**
     * Test to determine whether the program can get the value of
     * a specific column from a table.
     * 
     * @return void
     */
    public function testCanGetSpecificColumn()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertEquals(
            $this->_defaultColumnValue, $connection->get(
                $this->_defaultTable,
                $this->_defaultColumn,
                $this->_defaultColumnValue,
                $this->_defaultColumn
            )
        );
    }

    /**
     * Test to determine whether the program can update a column of
     * a row from a specified table.
     * 
     * @return void
     */
    public function testCanUpdateInDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertTrue(
            $connection->update(
                $this->_defaultTable,
                $this->_defaultColumn,
                $this->_defaultColumnValue,
                $this->_defaultColumn,
                $this->_defaultColumnValueAfterUpdate
            )
        );

        $actualValue = $connection->get(
            $this->_defaultTable,
            $this->_defaultColumn,
            $this->_defaultColumnValueAfterUpdate,
            $this->_defaultColumn
        );

        $this->assertEquals($this->_defaultColumnValueAfterUpdate, $actualValue);
    }

    /**
     * Test to determine whether the program can delete a row from
     * a specified column.
     * 
     * @return void
     */
    public function testCanDeleteFromDatabase()
    {
        $database = new Database();
        $connection = new DatabaseOperations($database->getInstance());
        $this->assertTrue(
            $connection->delete(
                $this->_defaultTable,
                $this->_defaultColumn,
                $this->_defaultColumnValueAfterUpdate
            )
        );
    }
}