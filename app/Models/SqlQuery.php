<?php

namespace App\Models;

use Exception;
use Models\DatabaseTable;

class SqlQuery
{
    private string $sqlString;
    private array $parameters;
    private string $tableName;

    public function __construct(string $sqlString = '' /*string $tableName, array $parameters = []*/) {
//        $this->parameters = $parameters;
//        $this->tableName = $tableName;
        $this->sqlString = $sqlString;
    }

    public function select($tableName):SqlQuery {
        $this->sqlString = "SELECT * FROM $tableName";
        return $this;
    }

    /**
     * @throws Exception
     */
    public function where(array $param = []):SqlQuery {
        if (empty($param)) throw new Exception("Аргумент не моежет быть пустым");
        $sql = '';
        foreach ($param as $key => $value) {
            $sql .= sprintf('%s = %s AND ', $key, $value);
        }
        if (strchr($this->sqlString,'WHERE')) {
            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND (';
        } else {
            $this->sqlString .= ' WHERE ';
        }
        $this->sqlString .= substr($sql, 0, -4) . ';';
        return $this;
    }

    /**
     * @throws Exception
     */
    public function whereIn(array $param = []):SqlQuery {
        if (empty($param)) throw new Exception("Аргумент не моежет быть пустым");
        $sql = '';
        foreach ($param as $arr) {
            $value_set = '(' . implode($arr[1], ', ') . ') ';
            $sql .= sprintf('%s IN %s AND ', $arr[0], $value_set);
        }
        if (strchr($this->sqlString,'WHERE')) {
            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND ';
        } else {
            $this->sqlString .= ' WHERE ';
        }
        $this->sqlString .= substr($sql, 0, -6) . ';';

        return $this;
    }

    /**
     * @throws Exception
     */
    public function whereOr(array $param = []):SqlQuery {
        if (empty($param)) throw new Exception("Аргумент не моежет быть пустым");
        $sql = '(';
        foreach ($param as $key => $value) {
            $sql .= sprintf('%s = %s OR ', $key, $value);
        }
        if (strchr($this->sqlString,'WHERE')) {
            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND ';
        } else {
            $this->sqlString .= ' WHERE ';
        }
        $this->sqlString .= substr($sql, 0, -4) . ');';
        return $this;
    }
}
