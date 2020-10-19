<?php

namespace App\Database;

use App\Database\Database;

class DatabaseOperations
{
    public function __construct(Database $databaseInstance)
    {
        $this->connection = $databaseInstance->getConnection();
    }

    /**
     * Allows for inserting data into the database.
     * 
     * @return mixed bool|string
     */
    public function insert($table, $values)
    {
        $placeholders = [];

        for ($index = 0; $index < count($values); $index++) {
            $placeholders[] = '?';
        }

        $sql = 'INSERT IGNORE INTO '. $table .'  (' . implode(',', array_keys($values)) . ')';
        $sql .=  ' VALUES ('. implode(',', $placeholders) .')';

        $statement = $this->connection->prepare($sql);

        try {
            $statement->execute(array_values($values));
        }
        catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

        return $this->connection->lastInsertId();
    }

    /**
     * Allows for retrieving data from the database.
     * 
     * @return mixed array|string
     */
    public function get($table, $where, $value, $columnToGet = '*')
    {
        $sql = "SELECT $columnToGet FROM $table where $where = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$value]);
        $results = $statement->fetch();

        if ($columnToGet == '*')
        {
            return $results;
        }
        return $results[$columnToGet];
    }

    public function update($table, $where, $value, $columnToUpdate, $newValue): bool
    {
        $sql = "UPDATE $table SET $columnToUpdate = ? WHERE $where = ?";
        $statement = $this->connection->prepare($sql);
        return $statement->execute([$newValue, $value]);
    }

    public function delete($table, $where, $value): bool
    {
        $sql = "DELETE FROM $table WHERE $where = ?";

        $statement = $this->connection->prepare($sql);
        return $statement->execute([$value]);
    }
}