<?php

class DB
{
    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Ошибка подключения: " . $this->conn->connect_error);
        }
    }

    public function executeQuery($query)
    {
        $result = $this->conn->query($query);

        if (!$result) {
            die("Ошибка выполнения запроса: " . $this->conn->error);
        }

        return $result;
    }

    public function escapeString($string)
    {
        return $this->conn->real_escape_string($string);
    }
}
