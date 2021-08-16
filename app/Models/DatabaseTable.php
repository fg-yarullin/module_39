<?php
namespace Models;
use PDO;
use PDOException;
use DateTime;

class DatabaseTable {
    private $pdo;
    private $table;
    private $primaryKey;
    private $className;
    private $constructorArgs;

    public function __construct(PDO $pdo, string $table, string $primaryKey,
    string $className = '\stdClass', array $constructorArgs = []) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    private function query($sql, $parameters = []) {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    public function total($field = null, $value = null) {
        $query = 'SELECT COUNT(*) FROM `' . $this->table . '`';
        if (!empty($field)) $query .= ' WHERE `' . $field . '` = :value';
        $parametrs = ['value' => $value];
        $result = $this->query($query, $parametrs);
        $row = $result->fetch();
        return $row[0];
    }

    public function insert($fields) {
        $query = 'INSERT INTO `' . $this->table . '` (';
        $partOfQuery = ') VALUES (';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`, ';
            $partOfQuery .= ':' . $key . ', ';
        }
        $query = rtrim($query, ', ');
        $partOfQuery = rtrim($partOfQuery, ', ');
        $query .= $partOfQuery . ')';
        $fields = $this->processDate($fields);
        $this->query($query, $fields);

        return $this->pdo->lastInsertId();
    }

    public function update($fields) {
        $query = 'UPDATE `' . $this->table . '` SET ';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ', ';
        }
        $query = rtrim($query, ', ');
        $query .= ' WHERE `' . $this->primaryKey . '`=:primaryKey;';
        $fields = $this->processDate($fields);
        $fields['primaryKey'] = $fields['id'];
        $this->query($query, $fields);
    }

    public function delete($value) {
        $query = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
        $parameters = [':value' => $value];
        $this->query($query, $parameters);
    }

    public function deleteWhere($column, $value) {
        $query = 'DELETE FROM `' . $this->table . '` WHERE `' . $column . '` = :value';
        $parameters = [':value' => $value];
        $this->query($query, $parameters);
    }

    public function findAll($orderBy = null, $limit = null, $offset = null) {
        $query = 'SELECT * FROM ' . $this->table;
        if ($orderBy) $query .= ' ORDER BY ' . $orderBy;
        if ($limit) $query .= ' LIMIT ' . $limit;
        if ($offset) $query .= ' OFFSET ' . $offset;
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
    }

    public function findById($value) {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
        $parameters = [':value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetchObject($this->className, $this->constructorArgs);
    }

    public function find($column, $value, $orderBy = null, $limit = null, $offset = null) {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $column . '` = :value';
        $parameters = [':value' => $value];
        if ($orderBy) $query .= ' ORDER BY ' . $orderBy;
        if ($limit) $query .= ' LIMIT ' . $limit;
        if ($offset) $query .= ' OFFSET ' . $offset;
        $query = $this->query($query, $parameters);
        return $query->fetchAll(PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
    }

    public function save($record) {
        $entity = new $this->className(...$this->constructorArgs);
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }

            $insertId = $this->insert($record);
            $entity->{$this->primaryKey} = $insertId;
        } catch (PDOException $e) {
            $this->update($record);
        }

        foreach ($record as $key => $value) {
            if (!empty($value)) {
                $entity->$key = $value;
            }
        }

        return $entity;
    }

    private function processDate($fields) {
        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format(('Y-m-d'));
            }
        }
        return $fields;
    }
}
