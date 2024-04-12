<?php
require_once 'DBConnect.php';
class DBModel
{
    private $db;
    public function __construct()
    {
        $this->db = connect();
    }

    // create table
    public function createTable($table, $fields)
    {
        $sql = "CREATE TABLE $table (";
        foreach ($fields as $key => $value) {
            $sql .= $key . ' ' . $value . ', ';
        }
        $sql = rtrim($sql, ', ');
        $sql .= ')';
        return executeQuery($sql);
    }

    // create table with foreign key
    public function createTableForeignKey($table, $fields, $foreignKeys)
    {
        $sql = "CREATE TABLE $table (";
        foreach ($fields as $key => $value) {
            $sql .= $key . ' ' . $value . ', ';
        }
        foreach ($foreignKeys as $key => $value) {
            $sql .= 'FOREIGN KEY (' . $key . ') REFERENCES ' . $value . ', ';
        }
        $sql = rtrim($sql, ', ');
        $sql .= ')';
        return executeQuery($sql);
    }

    // select 
    public function selectAll($table)
    {
        return executeQuery("SELECT * FROM $table");
    }


    public function selectMutliTable($table1, $table2, $on)
    {
        return executeQuery("SELECT * FROM $table1, $table2 WHERE $on");
    }

    public function selectWhere($table, $where)
    {
        return executeQuery("SELECT * FROM $table WHERE $where");
    }

    public function selectMutliTableWhere($table1, $table2, $on, $where)
    {
        return executeQuery("SELECT * FROM $table1, $table2 WHERE $on AND $where");
    }

    // insert, update, delete
    public function insert($table, $data)
    {
        $sql = "INSERT INTO $table (";
        foreach ($data as $key => $value) {
            $sql .= $key . ', ';
        }
        $sql = rtrim($sql, ', ');
        $sql .= ') VALUES (';
        foreach ($data as $key => $value) {
            $sql .= "'$value'" . ', ';
        }
        $sql = rtrim($sql, ', ');
        $sql .= ')';
        return executeQuery($sql);
    }

    public function update($table, $data, $where)
    {
        $sql = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $sql .= $key . " = '$value'" . ', ';
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE $where";
        return executeQuery($sql);
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        return executeQuery($sql);
    }
}