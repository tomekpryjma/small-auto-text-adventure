<?php

require __DIR__ . '/../vendor/autoload.php';
require 'config.php';

use App\Database\Database;
use App\Database\DatabaseOperations;

$database = new Database();
$connection = new DatabaseOperations($database);