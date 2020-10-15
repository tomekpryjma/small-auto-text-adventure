<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\Database\Database;
use \PDO;

class DatabaseConnectionTest extends TestCase
{
    public function testCanConnectToTheDatabase()
    {
        $database = new Database();
        $this->assertInstanceOf(PDO::class, $database->getConnection());
    }
}