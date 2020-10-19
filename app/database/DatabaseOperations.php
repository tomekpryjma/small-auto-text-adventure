<?php

namespace App\Database;

use App\Database\Database;

class DatabaseOperations
{
    public function __construct(Database $databaseInstance)
    {
        $this->connection = $databaseInstance->getConnection();
    }

    public function insert($table, $values): bool
    {
        $placeholders = [];

        for ($index = 0; $index < count($values); $index++) {
            $placeholders[] = '?';
        }

        $sql = 'INSERT INTO '. $table .'  (' . implode(',', array_keys($values)) . ')';
        $sql .=  ' VALUES ('. implode(',', $placeholders) .')';

        $statement = $this->connection->prepare($sql);
        return $statement->execute(array_values($values));
    }

    public function get($table, $where, $value, $columnToGet = '*') //: mixed
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