<?php
require_once 'config.class.php';
class database
{
    private $conn = null;
    public function __construct()
    {
        $this->conn = new mysqli(
            config::$db['host'],
            config::$db['username'],
            config::$db['password'],
            config::$db['db_name']
        );
        if ($this->conn->connect_error) {

            die("Connect Error " . $this->conn->connect_errorno . " :\n" . $this->conn->connect_error);
        }
    }

    public function get_connection()
    {
        return $this->conn;
    }

    public function close()
    {
        $this->conn->close();
    }
}