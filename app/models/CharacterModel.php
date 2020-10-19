<?php

namespace App\Models;

use App\Database\DatabaseOperations;
use App\Models\Model;

class CharacterModel extends Model
{
    protected $_table = 'characters';

    public function __construct(DatabaseOperations $connection, string $name)
    {
        $this->_schema = [
            'name' => $name,
            'alive' => true,
            'longest_streak' => 0
        ];
        parent::__construct($connection);
    }
}