<?php

namespace App\Models;

use Exception;
use Models\DatabaseTable;

class SqlQuery
{
    private string $sqlString;
    private array $parameters;
    private string $tableName;

    public function __construct(string $sqlString = '', array $parameters = [] /*string $tableName*/) {
        $this->parameters = $parameters;
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
            $paramName = $this->uidString(2);
            $sql .= sprintf('%s = :%s AND ', $key, $paramName);
            $this->parameters[$paramName] = $value;
        }
        if (strchr($this->sqlString,'WHERE')) {
            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND (';
        } else {
            $this->sqlString .= ' WHERE ';
        }
        $this->sqlString .= substr($sql, 0, -4) . ';';
        return $this;
    }

//    public function where(array $param = []):SqlQuery {
//        if (empty($param)) throw new Exception("Аргумент не моежет быть пустым");
//        $sql = '';
//        foreach ($param as $key => $value) {
//            $sql .= sprintf('%s = %s AND ', $key, $value);
//        }
//        if (strchr($this->sqlString,'WHERE')) {
//            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND (';
//        } else {
//            $this->sqlString .= ' WHERE ';
//        }
//        $this->sqlString .= substr($sql, 0, -4) . ';';
//        return $this;
//    }

    /**
     * @throws Exception
     */
    public function whereIn(array $param = []):SqlQuery {
        if (empty($param)) throw new Exception("Аргумент не моежет быть пустым");
        $sql = '';
        foreach ($param as $arr) {
            $value_set = '(' . implode($arr[1], ', ') . ') ';
            $paramName = $this->uidString(2);
            $sql .= sprintf('%s IN :%s AND ', $arr[0], $paramName);
            $this->parameters[$paramName] = $value_set;
        }
        if (strchr($this->sqlString,'WHERE')) {
            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND ';
        } else {
            $this->sqlString .= ' WHERE ';
        }
        $this->sqlString .= substr($sql, 0, -5) . ';';

        return $this;
    }

//    /**
//     * @throws Exception
//     */
//    public function whereIn(array $param = []):SqlQuery {
//        if (empty($param)) throw new Exception("Аргумент не моежет быть пустым");
//        $sql = '';
//        foreach ($param as $arr) {
//            $value_set = '(' . implode($arr[1], ', ') . ') ';
//            $sql .= sprintf('%s IN %s AND ', $arr[0], $value_set);
//        }
//        if (strchr($this->sqlString,'WHERE')) {
//            $this->sqlString = substr($this->sqlString, 0, -1) . ' AND ';
//        } else {
//            $this->sqlString .= ' WHERE ';
//        }
//        $this->sqlString .= substr($sql, 0, -6) . ';';
//
//        return $this;
//    }

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

    private function uidString(int $prefix_length): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($i = 0; $i < $prefix_length; $i++) {
            $string .= $characters[rand(0, strlen($characters))-1];
        }
        $string .= '_';
        return uniqid($string);
    }
}
