<?php

namespace App\Database;

use App\Database\Database;

class DatabaseOperations
{
    public function __construct(Database $databaseInstance)
    {
        $this->connection = $databaseInstance->getConnection();
    }

    public function insertInto($table, $values): bool
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

    public function deleteFrom($table, $key, $value): bool
    {
        $sql = "DELETE FROM $table WHERE $key = ?";

        $statement = $this->connection->prepare($sql);
        return $statement->execute([$value]);
    }
}