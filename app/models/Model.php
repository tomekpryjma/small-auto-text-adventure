<?php

namespace App\Models;

use App\Database\DatabaseOperations;
use App\Traits\DebugTrait;
use PDOException;

class Model
{
    use DebugTrait;

    protected static $_table;
    protected $_schema = [];
    private $_data = [];
    protected $_id;

    public function __construct(DatabaseOperations $connection, $id = null)
    {
        $this->connection = $connection;

        if ($id) {
            $this->_id = $id;
        }
    }

    /**
     * Adds the specified model to the database.
     * 
     * @return Model
     * 
     * @throws PDOException
     */
    public function add(): Model
    {
        $result = $this->connection->insert(static::$_table, $this->_schema);

        if (! $result)  {
            throw new PDOException('Model insertion failed');
        }

        $this->setModelId($result);

        return $this->get();
    }

    /**
     * Gets the specified model from the database.
     * 
     * @return Model
     */
    public function get(): Model
    {
        $result = $this->connection->get(static::$_table, 'id', $this->_id);

        $this->setupModelProperties($result);

        return $this;
    }

    /**
     * Deletes the model's record from the database.
     * 
     * @return bool
     */
    public function delete(): bool
    {
        return $this->connection->delete(static::$_table, 'id', $this->_id);
    }

    /**
     * Sets the model's id.
     * 
     * @return void
     */
    protected function setModelId($id): void
    {
        $this->_id = $id;
    }

    /**
     * Returns a value from $_data or null.
     * 
     * @return mixed|null
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }

        $this->debugBacktrace($name);
        return null;
    }

    /**
     * Sets a value in $_data.
     * 
     * @return void
     */
    public function __set($name, $value): void
    {
        $this->_data[$name] = $value;
    }

    /**
     * Retrieves a row from the database and parses it as a Model instance.
     */
    public static function find($id, DatabaseOperations $connection): Model
    {
        $model = new Model($connection, $id);
        return $model->get();
    }

    /**
     * Maps retrieved columns and values to this model's
     * properties.
     * 
     * @return void
     */
    protected function setupModelProperties($result): void
    {
        foreach ($result as $column => $value)
        {
            $this->{$column} = $value;
        }
    }
}