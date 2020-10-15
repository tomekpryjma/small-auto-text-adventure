<?php

namespace App\Database;

use App\Database\Database;

class DatabaseOperations
{
    public function __construct(Database $databaseInstance)
    {
        $this->connection = $databaseInstance->getConnection();
    }
}