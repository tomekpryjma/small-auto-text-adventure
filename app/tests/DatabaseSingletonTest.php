<?php

namespace App;

use PHPUnit\Framework\TestCase;
use App\Database\Database;

require __DIR__ . '../../config.php';

final class DatabaseSingletonTest extends TestCase
{
    public function testDatabaseSingletonIsInstanceOfDatabaseClass()
    {
        $database = new Database();
        $this->assertInstanceOf(Database::class, $database->getInstance());
    }

    public function testDatabaseInstancesAreTheSameInstanceOfSingleton()
    {
        $database = new Database();
        $database2 = new Database();
        $this->assertSame($database->getInstance(), $database2->getInstance());
    }
}