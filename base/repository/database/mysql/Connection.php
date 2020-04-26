<?php

namespace base\repository\database\mysql;

use mysqli;

class Connection
{
    private string $host;
    private int $port;
    private string $database;
    private string $username;
    private string $password;
    private static object $connection;
    private mysqli $connector;

    public function __construct()
    {
        $this->host = config('database.mysql.host');
        $this->port = config('database.mysql.port');
        $this->database = config('database.mysql.database');
        $this->username = config('database.mysql.username');
        $this->password = config('database.mysql.password');
    }

    public function open()
    {
        $this->connector = mysqli_connect($this->host, $this->username, $this->password, $this->database, $this->port);
        if (!$this->connector) {
            die('Could not connect: ' . mysqli_error($this->connector));
        }
    }

    public function close()
    {
        mysqli_close($this->connector);
    }

    public function commit($sql)
    {
        $this->open();
        $result = mysqli_query($this->connector, $sql);
        if (empty($result)) {
            echo "Error: " . mysqli_error($this->connector);
        }
        $this->close();
        return $result;
    }

    /**
     * Query records in database
     * @param $sql : query script
     * @return array: list of records
     */
    public function query($sql) {
        $queryResult = $this->commit($sql);
        $result = [];
        while($row = mysqli_fetch_assoc($queryResult)) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * @param $sql : query string
     * @return array: first record
     */
    public function first($sql) {
        $result = $this->query($sql);
        if(count($result) > 0) {
            return $result[0];
        }
        return null;
    }

    public static function getInstance()
    {
        if (empty(self::$connection)) {
            self::$connection = new Connection();
        }
        return self::$connection;
    }
}
